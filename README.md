combuilder
=================

A CLI utility for generating Joomla components

[![oclif](https://img.shields.io/badge/cli-oclif-brightgreen.svg)](https://oclif.io)
[![Version](https://img.shields.io/npm/v/combuilder.svg)](https://npmjs.org/package/combuilder)
[![Downloads/week](https://img.shields.io/npm/dw/combuilder.svg)](https://npmjs.org/package/combuilder)
[![License](https://img.shields.io/npm/l/combuilder.svg)](https://github.com/com-builder/combuilder/blob/master/package.json)

Basic Usage
==================
```
# Install via NPM
$ npm install -g combuilder
# Basic component creation. This component provides to the ablility to
# auto-fill component metadata and file level block comments
$ combuilder create COMPONENTNAME VIEWNAME -g -u http://yoursite.com
> com_COMPONENTNAME successfully created
$ joomlaly --help [COMMAND]
> USAGE
  $ combuilder COMMAND
```

Commands
=================
* [`combuilder create [NAME] [VIEW]`](#joomlaly-create-name-view)
* [`combuilder help [COMMAND]`](#joomlaly-help-command)

# `combuilder create [name] [view]`
```
creates a Joomla component based on options provided

USAGE
  $ combuilder create NAME VIEW

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
  $ combuilder create NAME VIEW
```
# `combuilder help [COMMAND]`