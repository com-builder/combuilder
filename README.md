joomlafy
=================

A CLI utility for generating Joomla components

[![oclif](https://img.shields.io/badge/cli-oclif-brightgreen.svg)](https://oclif.io)
[![Version](https://img.shields.io/npm/v/joomlafy.svg)](https://npmjs.org/package/joomlafy)
[![Downloads/week](https://img.shields.io/npm/dw/joomlafy.svg)](https://npmjs.org/package/joomlafy)
[![License](https://img.shields.io/npm/l/joomlafy.svg)](https://github.com/jeremyvii/joomlafy/blob/master/package.json)

<!-- toc -->
* [Usage](#usage)
* [Commands](#commands)
<!-- tocstop -->
# Usage
<!-- usage -->
```sh-session
$ npm install -g joomlafy
$ joomlafy COMMAND
running command...
$ joomlafy (-v|--version|version)
joomlafy/0.0.0 linux-x64 node-v8.10.0
$ joomlafy --help [COMMAND]
USAGE
  $ joomlafy COMMAND
...
```
<!-- usagestop -->
# Commands
<!-- commands -->
* [`joomlafy hello [FILE]`](#joomlafy-hello-file)
* [`joomlafy help [COMMAND]`](#joomlafy-help-command)

## `joomlafy hello [FILE]`

describe the command here

```
USAGE
  $ joomlafy hello [FILE]

OPTIONS
  -f, --force
  -h, --help       show CLI help
  -n, --name=name  name to print

EXAMPLE
  $ joomlafy hello
  hello world from ./src/hello.ts!
```

_See code: [src/commands/hello.ts](https://github.com/jeremyvii/joomlafy/blob/v0.0.0/src/commands/hello.ts)_

## `joomlafy help [COMMAND]`

display help for joomlafy

```
USAGE
  $ joomlafy help [COMMAND]

ARGUMENTS
  COMMAND  command to show help for

OPTIONS
  --all  see all commands in CLI
```

_See code: [@oclif/plugin-help](https://github.com/oclif/plugin-help/blob/v2.1.4/src/commands/help.ts)_
<!-- commandsstop -->
