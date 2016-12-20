# jira-cli
simple JIRA command line interface(CLI) in PHP.

Inspired by [go-jira](https://github.com/Netflix-Skunkworks/go-jira), [jira-cmd](https://github.com/germanrcuriel/jira-cmd) and [JIRA Command Line Interface](https://bobswift.atlassian.net/wiki/display/JCLI/User%27s+Guide).

# Requirements

- PHP >= 5.6.0
- [php jira rest client](https://github.com/lesstif/php-jira-rest-client)
- PHP Posix extension for [cliMenu](https://github.com/php-school/cli-menu)

# Installation

1. Download PHAR package.

   ``` sh
   mkdir jira-cli
   cd jira-cli
   wget https://github.com/lesstif/jira-cli/releases/download/0.1.0/jira-cli.phar.gz
   ```
2. Decompress downloaded package.

   ```sh
   gzip -d jira-cli.phar.gz
   ```

3. create .env on your jira-cli directory and editing it.

   ``` sh
   JIRA_HOST="https://your-jira.host.com"
   JIRA_USER="jira-username"
   JIRA_PASS="jira-password"
   ```



# Usage

## Project
- [Get Project Info](#get-project-info)
- [Get All Project list](#get-all-project-list)

### Get Project Info

```sh
$ php jira-cli.phar project:show MYPROJECT --field-exclude "self,avatarUrls,roles,versions"
```

### Get All Project list

```sh
$ php jira-cli.phar project:list --field-exclude "self,projectCategory,avatarUrls"
```