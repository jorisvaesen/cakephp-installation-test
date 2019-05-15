<?php
namespace InstallationTest\Tester;


use InstallationTest\Exception\TestFailedException;

interface TesterInterface
{
    /**
     * @return bool
     * @throws TestFailedException
     */
    public function test() : bool;
}