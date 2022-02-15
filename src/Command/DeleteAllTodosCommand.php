<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 27.01.22
 * Time: 23:45
 */

namespace App\Command;


use App\Entity\Todo;
use App\Repository\ToDoRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class DeleteAllTodosCommand extends Command
{
    protected static $defaultName = 'app:delete-all-todos';

    protected static $defaultDescription = 'Set all Todos parameters isActive=0, isDeleted=1';

    private $prev;

    private $repository;

    public function __construct(ToDoRepository $repository, bool $prev = false)
    {
        $this->repository = $repository;
        $this->prev = $prev;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command set all Todos parameters isActive=0, isDeleted=1')
            ->addArgument('prev', $this->prev ? InputArgument::REQUIRED : InputArgument::OPTIONAL, 'cancels the operation');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Continue with this action?', false);

        if (!$helper->ask($input, $output, $question)) {
            $output->writeln([
                'Canceled',
            ]);
            return Command::SUCCESS;
        }
        $obj = $this->repository->deleteAll();
        if($obj){
            $output->writeln([
                'All todos already deleted',
            ]);
            return Command::FAILURE;
        }else{
            $output->writeln([
                'Success',
            ]);
            return Command::SUCCESS;
        }


    }



}