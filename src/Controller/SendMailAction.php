<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SendMailAction extends AbstractController
{
    /** @var string $status */
    private $status = 'error';

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $response = new Response();

        $name       = $request->request->get('name');
        $email      = $request->request->get('email');
        $title      = $request->request->get('subject');
        $sendTo     = $request->request->get('sendto');
        $sendFrom   = $request->request->get('sendfrom');

        $body =  'Poruka od '    . $name  . '<br /><br />';
        $body .= 'Email adresa ' . $email . '<br /><br />';

        $body .= $request->request->get('message');

        $transport = new \Swift_SmtpTransport();
        $mailer = new \Swift_Mailer($transport);
        $logger = new \Swift_Plugins_Loggers_ArrayLogger;
        $mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($logger));

        $message = (new \Swift_Message($title))
            ->setFrom($sendFrom)
            ->setTo($sendTo)
            ->setBody($body,
                'text/html'
            );

        $mailerResponse = $mailer->send($message);

        if ($mailerResponse) {
            $this->status = 'success';
        }

        $response->setContent(json_encode($this->status));
        return $response;
    }
}
