<?php

/*
 * Classe etendant la classe du FOSUserBundle
 */

namespace Palabre\UserBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;



class CreateUserCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('palabre:user:create')
            ->setDescription('Create a user.')
            ->setDefinition(array(
                new InputArgument('firstname', InputArgument::REQUIRED, 'The first name'),
                new InputArgument('lastname', InputArgument::REQUIRED, 'The last name'),
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password'),
                new InputOption('super-admin', null, InputOption::VALUE_NONE, 'Set the user as super admin'),
                new InputOption('inactive', null, InputOption::VALUE_NONE, 'Set the user as inactive'),
            ))
            ->setHelp(<<<EOT
The <info>palabre:user:create</info> command creates a user:

  <info>php app/console palabre:user:create mdupond</info>

This interactive shell will ask you for an email and then a password.

You can alternatively specify the email and password as the second and third arguments:

  <info>php app/console palabre:user:create mathieu dupond mdupond matthieu@example.com mypassword</info>

You can create a super admin via the super-admin flag:

  <info>php app/console palabre:user:create admin --super-admin</info>

You can create an inactive user (will not be able to log in):

  <info>php app/console palabre:user:create mdupond --inactive</info>

EOT
            );

    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $firstname  = $input->getArgument('firstname');
        $lastname   = $input->getArgument('lastname');
        $username   = $input->getArgument('username');
        $email      = $input->getArgument('email');
        $password   = $input->getArgument('password');
        $inactive   = $input->getOption('inactive');
        $superadmin = $input->getOption('super-admin');

        $manipulator = $this->getContainer()->get('palabre_user.util.user_manipulator');
        $manipulator->createPalabreUser($firstname, $lastname, $username, $password, $email, !$inactive, $superadmin);

        $output->writeln(sprintf('Created user <comment>%s</comment>', $username));
    }

    /**
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('firstname')) {
            $firstname = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a firstname:',
                function($firstname) {
                    if (empty($firstname)) {
                        throw new \Exception('Firstname can not be empty');
                    }

                    return $firstname;
                }
            );
            $input->setArgument('firstname', $firstname);
        }
        if (!$input->getArgument('lastname')) {
            $lastname = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a lastname:',
                function($lastname) {
                    if (empty($lastname)) {
                        throw new \Exception('Lastname can not be empty');
                    }

                    return $lastname;
                }
            );
            $input->setArgument('lastname', $lastname);
        }
        if (!$input->getArgument('username')) {
            $username = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a username:',
                function($username) {
                    if (empty($username)) {
                        throw new \Exception('Username can not be empty');
                    }

                    return $username;
                }
            );
            $input->setArgument('username', $username);
        }

        if (!$input->getArgument('email')) {
            $email = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose an email:',
                function($email) {
                    if (empty($email)) {
                        throw new \Exception('Email can not be empty');
                    }

                    return $email;
                }
            );
            $input->setArgument('email', $email);
        }

        if (!$input->getArgument('password')) {
            $password = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a password:',
                function($password) {
                    if (empty($password)) {
                        throw new \Exception('Password can not be empty');
                    }

                    return $password;
                }
            );
            $input->setArgument('password', $password);
        }
    }
}
