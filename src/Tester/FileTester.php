<?php
namespace InstallationTest\Tester;


use InstallationTest\Exception\TestFailedException;

class FileTester implements TesterInterface
{
    private $files = [];
    private $root;

    private function __construct($root = null)
    {
        $this->root = $root;
    }

    public function requireFile($file)
    {
        $this->files[] = $file;
    }

    public function test() : bool
    {
        foreach ($this->files as $file) {
            if ($this->root) {
                $file = $this->root . $file;
            }

            if (!file_exists($file)) {
                throw new TestFailedException(sprintf('File %s not found.', $file));
            }
        }

        return true;
    }
}