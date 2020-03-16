<?php

namespace Deployer;

require 'recipe/symfony4.php';

set('application', 'projet_5');

set('repository', 'git@github.com:Ehyiah/projet5.git');

set('writable_dirs', ['var/cache']);
set('shared_files', ['.env']);

set('git_tty', false);
set('ssh_multiplexing', false);

set('default_stage', 'prod');

host('perso')
    ->hostname('projet5.gostiaux.net')
    ->stage('prod')
    ->set('deploy_path', '/var/www/projet5-test')
    ->user('deployer')
;

before('deploy:prepare', 'deploy:getversion');
after('deploy:failed', 'deploy:unlock');

before('deploy:symlink', 'database:migrate');

task('deploy:getversion', function () {
    $tags = explode("\n", runLocally('git tag --sort=v:refname'));
    if (count($tags) > 0) {
        set('branch', $tags[count($tags) - 1]);
    }
    $branch = ask('Version to deploy', get('branch'));
    set('branch', $branch);
});
