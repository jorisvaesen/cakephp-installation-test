<?php
namespace InstallationTest;


use InstallationTest\Exception\TestFailedException;
use InstallationTest\Tester\TesterInterface;

class InstallationTest
{
    private $testers = [];
    private $errors = [];

    public function registerTester(TesterInterface $tester)
    {
        $this->testers[] = $tester;
    }

    /**
     * @inheritDoc
     */
    public function test()
    {
        try {
            foreach ($this->testers as $tester) {
                $tester->test();
            }
        } catch (TestFailedException $ex) {
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
