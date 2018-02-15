[![Build Status](https://travis-ci.org/pmvc/pmvc-static.svg?branch=master)](https://travis-ci.org/pmvc/pmvc-static)

PMVC static host use with heroku or dokku 
===============

## Heroku or Dokku setting
```
dokku config:set [app name] imageMiddlewareUri=[specific uri]
dokku config:set [app name] staticRoot=[specific path]
```
* path could be an uri or local file path 

## URI Spec
/{c,d}/{c,j,other}/lib/semantic-ui/2.2.2/button.css
* First level
   * c -> cdn
   * d -> develop mode
* Second level
   * c -> css
   * j -> javascript
   * other or empty -> mean get source directily will not cook by css or js.


## Heroku one click deploy
[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy?template=https://github.com/pmvc/pmvc-static)

