<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 24/02/17
 * Time: 21:44
 */

namespace Slx\Infrastructure\Service\Mail;

use PHPMailer;
use Slx\Domain\Entity\Email\EmailTemplateInterface;
use Symfony\Component\Yaml\Parser as YamlParser;

class Mailer
{

    /**
     * @var PHPMailer
     */
    private $phpMailer;

    /**
     * @var string
     */
    private $configPath = __DIR__ . '/../../../../../config/files/mailconfig.yml';

    /**
     * Mailer constructor.
     * @param \Twig_Environment $twig
     */
    public function __construct($twig)
    {
        $parameters = $this->getMailerParameters();
        $this->phpMailer = new PHPMailer;
        $this->phpMailer->isSMTP();
        $this->phpMailer->SMTPDebug = 2;
        $this->phpMailer->Debugoutput = 'html';
        $this->phpMailer->Host = $parameters['mail']['host'];
        $this->phpMailer->Port = 587;
        $this->phpMailer->SMTPSecure = 'tls';
        $this->phpMailer->SMTPAuth = true;
        $this->phpMailer->Username = $parameters['mail']['username'];
        $this->phpMailer->Password = $parameters['mail']['password'];
        $this->phpMailer->setFrom($parameters['mail']['username']);

        $this->twig = $twig;
    }

    public function send(EmailTemplateInterface $emailTemplate)
    {
        $this->phpMailer->addAddress($emailTemplate->emailTo());
        $this->phpMailer->msgHTML($this->twig->render($emailTemplate->templatePath(), $emailTemplate->parameters()));

        if (!$this->phpMailer->send()) {
            throw new EmailNoSendedException();
        }
    }

    private function getMailerParameters(): array
    {
        $parser = new YamlParser();
        if (!file_exists($this->configPath)) {
            throw new ConfigFileDoesNotExistException();
        }
        return $parser->parse(file_get_contents($this->configPath));
    }
}
