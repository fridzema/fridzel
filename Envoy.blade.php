@servers(['production' => 'root@xxx.xxx.xxx'])
	@setup
			function taskLog($message, $icon = null) {
				$delimiter = "  ";
				$icon = (isset($icon)) ? $icon . $delimiter : null;

				return "echo '\033[1;32m" . $icon . $message. "\033[0m';\n";
			}

			// Change to your own values!
			$path = "/var/www/html";
			$gitProviderUrl = "https://github.com";
			$repositoryUser = "fridzema";
			$repositoryName = "fridzel";
	@endsetup

	@task('setup', ['on' => 'production'])
		{{ taskLog("Directory cleanup...", "👋") }}
		cd {{ $path }};
		rm -rf *;

		{{ taskLog("Cloning the repository ".$repositoryUser."/".$repositoryName."...", "⛓") }}
		cd {{ $path }};
		git clone {{$gitProviderUrl}}/{{$repositoryUser}}/{{$repositoryName}}.git --quiet;

		{{ taskLog("Fixing file permissions...", "🔓") }}
		cd {{ $path }};
		sudo chgrp -R www-data {{$repositoryName}};
		sudo chmod -R g+w {{$repositoryName}}/storage;
		sudo chmod -R g+w {{$repositoryName}}/public;

		{{ taskLog("Copy the env production file...", "⚙️") }}
		cd {{ $path }}/{{$repositoryName}};
		cp .env.production .env;

		{{ taskLog("Running composer...", "📦") }}
		composer install --prefer-dist --no-scripts --no-plugins --no-dev -o -q;

		{{ taskLog("Build and fill the database...", "🛠") }}
		php artisan migrate:refresh --seed --force -q;

		{{ taskLog("Speed things up a bit up...", "🏎") }}
		php artisan clear-compiled -q;
		php artisan optimize -q;
		php artisan cache:clear -q;
		php artisan view:clear -q;
		php artisan route:cache -q;
		php artisan config:cache -q;

		{{ taskLog("Keep it fresh...", "🛁") }}
		service mysql --full-restart;
		service nginx --full-restart;
		service php7.0-fpm --full-restart;
		service redis-server --full-restart;

		{{ taskLog("🙏🍾🍻🎂 DEPLOYED SUCCESFULLY 🎂🍻🍾🙏") }}
	@endtask

	@task('update', ['on' => 'production'])
		{{ taskLog("Pulling the repository ".$repositoryUser."/".$repositoryName."...", "⛓") }}
		cd {{ $path }}/{{$repositoryName}};
		git fetch --all;
		git reset --hard origin/master;

		{{ taskLog("Copy the env production file...", "⚙️") }}
		cp .env.production .env;

		{{ taskLog("Running composer...", "📦") }}
		composer install --prefer-dist --no-scripts --no-plugins --no-dev -o -q;

		{{ taskLog("Speeding things a bit up...", "🏎") }}
		php artisan clear-compiled -q;
		php artisan optimize -q;
		php artisan cache:clear -q;
		php artisan view:clear -q;
		php artisan route:cache -q;
		php artisan config:cache -q;
		php artisan responsecache:flush -q;
		php artisan opcache:optimize -q;

		{{ taskLog("Keep it fresh...", "🛁") }}
		service mysql --full-restart;
		service nginx --full-restart;
		service php7.0-fpm --full-restart;
		service redis-server --full-restart;

		{{ taskLog("🙏🍾🍻🎂 DEPLOYED SUCCESFULLY 🎂🍻🍾🙏") }}
	@endtask
{{-- php artisan medialibrary:regenerate -q --force; --}}
