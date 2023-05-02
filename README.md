1. git clone https://github.com/TWoolhouse/Slook.git
2. install [composer](https://getcomposer.org/)
3. run `compser install` from the terminal in the root directory of the project
4. Setup xampp to load the public directory
   1. Xampp apache httpd.conf
   2. line 252 253 chage the path to be `slook/public` or wherever you have it stored locally.
5. Add the sql data to the db using the `design/db/create.sql` statements.
6. Run xampp.
7. goto `localhost`
