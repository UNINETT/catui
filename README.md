# Eduroam connect utility

This program will provide end users with an easy and convenient front-end to the
CAT (Configuration Assistance Tool, cat.eduroam.org).  This application will use
CAT as its backend and does not need a database to function.  However, it will
store cache files in the system temp directory in order to offload the
international CAT server.

## Features
* Bookmarkable/documentable URLs
* Use browser's built-in history (previous/next page)
* Quick start - enter the name of your institution and press enter
* Lemon fresh design
* Easy to style
* Forkable

## License
This program is released under the terms of the GNU Affero General Public
License.

## Installation
A simple webserver supporting PHP will do.  Point the document root to the
`www/` directory.  The `curl` module is required, the `geoip` module is
recommended in order to make the page listing the identity providers more fancy.

## Demo
At UNINETT, where this program was developed, we have set up a demo for you to
use.  The UI will only provide access to Norwegian institutions, but by changing
the URL manually you can query other countries as well.  The demo is available
at https://cat.eduroam.no/
