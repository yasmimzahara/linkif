{ pkgs, ... }:

{
  languages.php.enable = true;
  languages.javascript.enable = true;
  languages.javascript.corepack.enable = true;

  packages = [ pkgs.nodejs_22];

  process.implementation = "overmind";
  processes = {
    npm-run.exec = "npm run dev";
    laravel-run.exec = "php artisan serve";

  };


  # https://devenv.sh/basics/
  # env.GREET = "devenv";

  # https://devenv.sh/packages/
  # packages = [ pkgs.git ];

  # https://devenv.sh/scripts/
  # scripts.hello.exec = "echo hello from $GREET";

  enterShell = ''
    export WKHTML_PDF_BINARY="$(pwd)/wkhtmltopdf"
  '';

  # https://devenv.sh/languages/
  # languages.nix.enable = true;

  # https://devenv.sh/pre-commit-hooks/
  # pre-commit.hooks.shellcheck.enable = true;

  # https://devenv.sh/processes/
  # processes.ping.exec = "ping example.com";

  # See full reference at https://devenv.sh/reference/options/
}
