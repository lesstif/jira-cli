# jira-cli
simple JIRA command line interface(CLI) in PHP.

Inspired by [go-jira](https://github.com/Netflix-Skunkworks/go-jira), [jira-cmd](https://github.com/germanrcuriel/jira-cmd) and [JIRA Command Line Interface](https://bobswift.atlassian.net/wiki/display/JCLI/User%27s+Guide).

# Requirements

- PHP >= 5.6.0
- [php jira rest client](https://github.com/lesstif/php-jira-rest-client)

# Installation

1. Download and Install PHP Composer.

	``` sh
	curl -sS https://getcomposer.org/installer | php
	```
2. Next, clone the project into your working directory.

    ```sh
    git clone https://github.com/lesstif/jira-cli
    cd jira-cli
    ```

3. Next, run the Composer command to install the latest version of the dependent libraries.

	``` sh
	php composer.phar install
	```

3. Then run Composer's install or update commands to complete installation.

	```sh
	php composer.phar install
	```


# Configuration

copy .env.example file to .env on your project root and editing it.

	JIRA_HOST="https://your-jira.host.com"
	JIRA_USER="jira-username"
	JIRA_PASS="jira-password"

# Usage

## Project
- [Get Project Info](#get-project-info)
- [Get All Project list](#get-all-project-list)

### Get Project Info

```sh
$ php jira-cli.php project:list --field-exclude "self,projectCategory,avatarUrls"
```

### Get All Project list

```sh
$ php jira-cli.php project:show MYPROJECT --field-exclude "self,avatarUrls,roles,versions"
```