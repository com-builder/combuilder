component-builder
=================

A CLI utility for generating Joomla components

[![oclif](https://img.shields.io/badge/cli-oclif-brightgreen.svg)](https://oclif.io)
[![Version](https://img.shields.io/npm/v/component-builder.svg)](https://npmjs.org/package/component-builder)
[![Downloads/week](https://img.shields.io/npm/dw/component-builder.svg)](https://npmjs.org/package/component-builder)
[![License](https://img.shields.io/npm/l/component-builder.svg)](https://github.com/jeremyvii/component-builder/blob/master/package.json)

<!-- toc -->
* [Usage](#usage)
* [Commands](#commands)
<!-- tocstop -->
# Usage
<!-- usage -->
```sh-session
$ npm install -g component-builder
$ component-builder COMMAND
running command...
$ component-builder (-v|--version|version)
component-builder/0.0.0 linux-x64 node-v8.10.0
$ component-builder --help [COMMAND]
USAGE
  $ component-builder COMMAND
...
```
<!-- usagestop -->
# Commands
<!-- commands -->
* [`component-builder hello [FILE]`](#component-builder-hello-file)
* [`component-builder help [COMMAND]`](#component-builder-help-command)

## `component-builder hello [FILE]`

describe the command here

```
USAGE
  $ component-builder hello [FILE]

OPTIONS
  -f, --force
  -h, --help       show CLI help
  -n, --name=name  name to print

EXAMPLE
  $ component-builder hello
  hello world from ./src/hello.ts!
```

_See code: [src/commands/hello.ts](https://github.com/jeremyvii/component-builder/blob/v0.0.0/src/commands/hello.ts)_

## `component-builder help [COMMAND]`

display help for component-builder

```
USAGE
  $ component-builder help [COMMAND]

ARGUMENTS
  COMMAND  command to show help for

OPTIONS
  --all  see all commands in CLI
```

_See code: [@oclif/plugin-help](https://github.com/oclif/plugin-help/blob/v2.1.4/src/commands/help.ts)_
<!-- commandsstop -->
