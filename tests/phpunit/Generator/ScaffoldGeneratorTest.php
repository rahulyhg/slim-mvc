<?php
namespace SlimApi\MvcTest\Generator;

use SlimApi\Mvc\Generator\ScaffoldGenerator;
use SlimApi\Mvc\Generator\ControllerGenerator;
use SlimApi\Mvc\Generator\ModelGenerator;

// class RouteServiceMock implements GeneratorServiceInterface {public function processCommand($type, ...$arguments){} public function create($name){} public function targetLocation($name){}}
// class ControllerServiceMock implements ControllerInterface {public $commands = []; public function create($name){} public function processCommand($type, $action){$this->commands[] = $action;} public function targetLocation($name){return 'src/Controller/'.$name.'Controller.php';}}
// class DependencyServiceMock implements GeneratorServiceInterface {public function processCommand($type, ...$arguments){return true;} public function create($name){return true;} public function targetLocation($name){return 'src/Model/'.$name.'Model.php';}}
//
//
// class PhinxService implements ModelInterface, GeneratorServiceInterface {
//     public $commands = [];
//     public function init($directory){}
//     public function processCommand($type, ...$arguments){$this->commands[] = $type;}
//     public function create($name){}
//     public function targetLocation($name){}
// }
// class PhinxApplicationMock {public function run(){return true;} public function find($name) { $class = '\Phinx\Console\Command\\'.ucfirst($name); return new $class; }}
// class CommandMock {public function run(){return 0;}}
// class PhinxApplication2Mock {public function run(){return true;} public function find($name) { return new CommandMock; }}
// class ModelServiceMock implements SlimApi\Migration\MigrationInterface {public function processCommand($type, ...$arguments){return true;} public function create($name){return true;} public function __construct($modelTemplate, $namespace){} public function targetLocation($name){return 'src/Model/'.$name.'Model.php';}}
// class DependencyServiceMock implements GeneratorServiceInterface {public function processCommand($type, ...$arguments){return true;} public function create($name){return true;} public function targetLocation($name){return 'src/Model/'.$name.'Model.php';}}

class ScaffoldGeneratorTest extends \PHPUnit_Framework_TestCase
{
    use \SlimApi\MvcTest\DirectoryTrait;
    protected function setUp()
    {
        $this->controllerGenerator = new ControllerGenerator(new ControllerServiceMock, new RouteServiceMock, new DependencyServiceMock);
        $this->modelGenerator      = new ModelGenerator(new ModelServiceMock('', ''), new PhinxService(new PhinxApplication2Mock), new DependencyServiceMock);
        $this->scaffoldGenerator   = new ScaffoldGenerator($this->controllerGenerator, $this->modelGenerator);
    }

    public function testValidate()
    {
        $this->assertTrue($this->scaffoldGenerator->validate('foo', []));
    }

    public function testProcess()
    {
        $this->scaffoldGenerator->process('foo', [], []);
    }

}
