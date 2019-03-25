joomlafy
=================

A CLI utility for generating Joomla components

[![oclif](https://img.shields.io/badge/cli-oclif-brightgreen.svg)](https://oclif.io)
[![Version](https://img.shields.io/npm/v/joomlafy.svg)](https://npmjs.org/package/joomlafy)
[![Downloads/week](https://img.shields.io/npm/dw/joomlafy.svg)](https://npmjs.org/package/joomlafy)
[![License](https://img.shields.io/npm/l/joomlafy.svg)](https://github.com/jeremyvii/joomlafy/blob/master/package.json)

Basic Usage
==================
```
# Install via NPM
$ npm install -g joomlafy
# Basic component creation. This component provides to the ablility to
# auto-fill component metadata and file level block comments
$ joomlafy create COMPONENTNAME VIEWNAME -g -u http://yoursite.com
> com_COMPONENTNAME successfully created
$ joomlaly --help [COMMAND]
> USAGE
  $ joomlafy COMMAND
```

Commands
=================
* [`joomlafy create [NAME] [VIEW]`](#joomlaly-create-name-view)
* [`joomlafy help [COMMAND]`](#joomlaly-help-command)

# `joomlafy create [name] [view]`
```
creates a Joomla component based on options provided

USAGE
  $ joomlafy create NAME VIEW

ARGUMENTS
  NAME  name of the component you wish to create
  VIEW  name of first view (item and list) to create

OPTIONS
  -a, --author=author          author name for component metadata
  -d, --createDate=createDate  created date for component metadata, current date is used if this option isn't present
  -e, --email=email            email address for component metadata
  -g, --useGit                 pull meta information from git configuration
  -h, --help                   show CLI help
  -u, --url=url                url for component metadata

EXAMPLE
  $ joomlafy create NAME VIEW
```
# `joomlafy help [COMMAND]`