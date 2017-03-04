<?php
/**
 * Created by PhpStorm.
 * User: dtome
 * Date: 26/02/17
 * Time: 21:03
 */

namespace Slx\Application\CommandHandler;


use Slx\Application\Command\CommandInterface;

interface CommandHandlerInterface
{

    /**
     *
     *
     * @param $command
     * @return mixed
     */
    public function execute(CommandInterface $command);
}
