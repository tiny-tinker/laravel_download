<?php

namespace App\Factories;

use App\User;
use App\Repositories\ActivationRepository;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Session;

class ActivationFactory
{
    protected $activationRepo;
    protected $mailer;
    protected $resendAfter = 24;

    public function __construct(ActivationRepository $activationRepo, Mailer $mailer)
    {
        $this->activationRepo = $activationRepo;
        $this->mailer = $mailer;
    }

    public function sendActivationMail($user)
    {
        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $referrer = session('referrer_id');

        $link = route('user.activate', [$token, $referrer]);
        //$message = sprintf('Activate account %s', $link, $link);

        $messagetemplate = "Hello %s,\n\nThank you for registering at OmniBazaar.com. Your account is created and must be activated before you can use it.\nTo activate the account select the following link or copy-paste it in your browser:\n%s \n\nAfter activation you may login to http://download.omniBazaar.com\n";                        

        $message = sprintf($messagetemplate, $user->name, $link);

        $this->mailer->raw($message, function (Message $m) use ($user) {
            $m->to($user->email)->subject('ACTION REQUIRED -- Activate your new OmniBazaar user account');
        });
    }

    public function activateUser($token, $referrer)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        if ($referrer!=='')
        {
            // Store referrer name to session
            session(['referrer_id'=>$referrer]);
        }

        $this->activationRepo->deleteActivation($token);

        return $user;
    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }
}