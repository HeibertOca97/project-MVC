<?php

namespace core\help;

trait RouteControllerFile
{

    /*****
        CONTROLLER DIRECTORY
     *******/
    public function getPathOfControllerAndNameSpace($namespace, $controllerName)
    {
        $controllers = glob("{$namespace}*.*");

        if (isset($controllers)) {
            $controller = "{$controllerName}Controller";
            $controller = ucwords($controller);
            $rootFile = [];
            $indexFile = [];

            foreach ($controllers as $key => $file) {
                $file = str_replace("/", "\\", $file);
                array_push($rootFile, $file);
            }

            foreach ($rootFile as $key => $file) {
                $arrayDir = explode("\\", $file);
                $lastValue = array_pop($arrayDir);
                $controllerName = explode(".", $lastValue);
                $name = array_shift($controllerName);
                if (strcmp($name, $controller) === 0) {
                    array_push($indexFile, $key);
                    break;
                }
            }

            if (empty($indexFile)) {
                return null;
            }

            $index = array_shift($indexFile);
            $pathFilename = $controllers[$index];
            $pathFilenameWithoutExtension = array_shift(explode(".", $controllers[$index]));
            $getNamespace = str_replace("/", "\\", $pathFilenameWithoutExtension);

            return array(
                "path" => $pathFilename,
                "namespace" => $getNamespace
            );
        }
        
        return null;
    }

    public function createAnArrayOfDirectories($path, $namespace)
    {
        try {
            $dir = null;
            $dirArray = [];
            if (is_dir($path) && $dir = opendir($path)) {
                while (($file = readdir($dir)) !== false) {
                    if (!is_file($path . $file) && $file != "." && $file != "..") {
                        $pathFilename = $path . $file . "/";
                        $pathNamespace = $namespace . $file . "/";

                        $this->createAnArrayOfDirectories($pathFilename, $pathNamespace);
                        array_push($dirArray, array(
                            "path" => $pathFilename,
                            "namespace" => $pathNamespace
                        ));
                    }
                }
                closedir($dir);
            }
            return $dirArray;
        } catch (\Exception $ex) {
            throw new \Exception(get_class($this) . " | Failed on the line: " . $ex->getLine() . ' | Message: ' . $ex->getMessage());
        }
    }
}
