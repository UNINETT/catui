# eduroam configurator

This program will provide end users with an easy and convenient
front-end to the CAT (Configuration Assistance Tool,
cat.eduroam.org).  This application will use CAT as its backend
and does not need a database to function.  However, it will
store cache files in the system temp directory in order to
offload the international CAT server.

## Goal
The goal of this project is to provide a user friendly user
interface towards the CAT database.  This should help convince
local eduroam administrators to put their profiles on CAT.
There are still many institutions that provide eduroam, but have not registered on CAT yet.

## Features
* Bookmarkable/documentable URLs
* Use browser's built-in history (previous/next page)
* Quick start - enter the name of your institution and press enter
* Directly get institution's CA pubkey PEM
* Lemon fresh design
* Easy to style
* Forkable

## License
This program is released under the terms of the GNU Affero
General Public License.

## Development
Just start the development server using the provided shell
script.  If you miss any dependencies, the script will alert you
about this.  The application requires PHP 7 with json and
curl extensions.

	make

## Installation
A simple webserver supporting PHP will do.  Point the document
root to the `www/` directory.  The `curl` module is required,
the `geoip` module is recommended in order to make the page
listing the identity providers more fancy.

## Demo
At UNINETT, where this program was developed, we have set up a
demo for you to use.  The UI will only provide access to
Norwegian institutions, but by changing the URL manually you can
query other countries as well.  The demo is available at
https://cat.eduroam.no/
