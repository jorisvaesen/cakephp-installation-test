<?php
namespace InstallationTest;


use Composer\IO\IOInterface;
use InstallationTest\Exception\TestFailedException;
use InstallationTest\Tester\TesterInterface;

class InstallationTest
{
    private $io;
    private $testers = [];
    private $errors = [];

    public function __construct(IOInterface $io = null)
    {
        $this->io = $io;
    }

    public function registerTester(TesterInterface $tester)
    {
        $this->testers[] = $tester;
    }

    /**
     * @inheritDoc
     */
    public function test($print = true)
    {
        try {
            foreach ($this->testers as $tester) {
                $tester->test();
            }
        } catch (TestFailedException $ex) {
            if ($print) {
                $this->io->write('<error>' . $ex->getMessage() . '</error>');
            }

            $this->errors[] = $ex->getMessage();
        }

        return true;
    }

    public function hasErrors()
    {
        return (bool)count($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
