<?php

namespace App\Services;

use App\Models\Module as Model;
use App\Models\Site;
use Module;
use Spatie\Permission\Models\Permission;

class ModuleService
{
    public function all()
    {
        return Module::toCollection()->map(function ($module) {
            return $this->find($module->getName());
        });
    }

    public function allInstalled()
    {
        return $this->all()->filter(function ($module) {
            return $module['installed'];
        });
    }

    public function find(string $name)
    {
        $model = Module::findOrFail($name);
        $config = $this->config($name, 'config');
        $model = Model::where('name', $name)->first();

        return $config + [
            'id' => $model['id'] ?? 0,
            'name' => $name,
            'description' => $config['description'],
            'version' => $config['version'],
            'preview' => "/modules/{$name}/static/preview.jpg",
            'menus' => $this->config($name, 'menus'),
            'installed' => (bool) $model,
            'model' => $model,
        ];
    }

    public function findBySite(Site $site, string $name)
    {
        $module = $this->find($name);
        return app(PermissionService::class)->addModulePermissionPrefix($site, $module);
    }

    protected function config(string $name, string $fileName)
    {
        $module = Module::findOrFail($name);
        $file = $module->getPath() . '/Config/' . $fileName . '.php';

        return is_file($file) ? include $file : [];
    }

    public function getSiteModules(Site $site)
    {
        return $site->master->group->modules->map(function ($module) use ($site) {
            return $this->findBySite($site, $module['name']);
        });
    }
}
