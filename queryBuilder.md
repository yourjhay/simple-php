# The Simply PHP Framewrok
[![Latest Stable Version](https://poser.pugx.org/simplyphp/framework/v/stable)](https://packagist.org/packages/simplyphp/framework)
[![Total Downloads](https://poser.pugx.org/simplyphp/framework/downloads)](https://packagist.org/packages/simplyphp/framework)
[![License](https://poser.pugx.org/simplyphp/framework/license)](https://packagist.org/packages/simplyphp/framework)
[![Monthly Downloads](https://poser.pugx.org/simplyphp/framework/d/monthly)](https://packagist.org/packages/simplyphp/framework)

# Query builder

## SELECT
A simple select will include all columns:
```php
$query = parent::factory()
    ->select()
    ->from('users')
    ->limit(100)
    ->compile();
/**
*  $query->sql(); - SELECT * FROM "users" LIMIT 100 
*  $query->params() - Parameters if available */

        $stmt = static::DB()->prepare($query->sql());
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
```
Specific columns can be selected:
```php
$query = parent::factory()
    ->select('id', 'username')
    ->from('users')
    ->compile();

$query->sql(); // SELECT "id", "username" FROM "users"
$query->params(); // []
```
Additional columns can be added:
```php
$query = parent::factory()
    ->select('id', 'username')
    ->addColumns('password')
    ->from('users')
    ->compile();

$query->sql(); // SELECT "id", "username", "password" FROM "users"
$query->params(); // []
```
As well as additional tables:
```php
$query = parent::factory()
    ->select('users.username', 'groups.name')
    ->from('users')
    ->addFrom('groups')
    ->compile();

$query->sql(); // SELECT "users"."username", "groups"."name" FROM "users", "groups"
$query->params(); // []
```
### Select Where
Criteria can be applied to the _WHERE_ condition:
```php
$query = parent::factory()
    ->select()
    ->from('users')
    ->where(field('username')->eq('simply@yahoo.com'))
    ->compile();
/*
$query->sql(); // SELECT * FROM "countries" WHERE "language" = ?
$query->params(); // ['simply@yahoo.com'] */

        /** Sample query: **/
        $stmt = static::DB()->prepare($query->sql());
        $stmt->execute($query->params()); // note that $query->params() is passed here.
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
```
Additional criteria can be added using _andWhere()_ and _orWhere()_:
```php
$query = parent::factory()
    ->select()
    ->from('users')
    ->where(field('id')->gt(1))
    ->orWhere(field('login_at')->isNull())
    ->orWhere(field('is_inactive')->eq(1))
    ->compile();
```
Would produce:
```
SELECT *
FROM "users"
WHERE "id" > ?
OR "login_at" IS NULL
OR "is_inactive" = ?
```
### JOIN
Joins are added in a similar way:
```php
$query = parent::factory()
    ->select('u.id', 'c.name')
    ->from(alias('users', 'u'))
    ->join(alias('countries', 'c'), on('u.country_id', 'c.id'))
    ->compile();
```
Would produce:
```
SELECT "u"."id", "c"."name"
FROM "users" AS "u"
JOIN "countries" AS "c" ON "u"."country_id" = "c"."id"
```
The join type can also be specified as the third parameters or one of the helpers can be used for common types:
- leftJoin()
- rightJoin()
- innerJoin()
- fullJoin()
### ORDER BY
Ordering can be applied:
```php
$query = parent::factory()
    ->select()
    ->from('users')
    ->orderBy('username', 'asc');
```
Ordering can be reset:
```php
$query->orderBy(null);
```
### LIMIT and OFFSET
Limits and offsets can be applied:
```php
$query = parent::factory()
    ->select()
    ->from('posts')
    ->offset(10)
    ->limit(10)
    ->compile();
```
Note: When using the SQL Server engine an offset must be defined for the limit to be applied! Use offset(0) when no offset is desired.

## INSERT
Inserts can be performed with a single row:
```php
$query = parent::factory()
    ->insert('places', [
        'name' => 'home',
        'address' => '123 Main St'
    ])
    ->compile();

$query->sql(); // INSERT INTO "places" ("name", "address") VALUES (?, ?)
$query->params(); // ['home', '123 Main St']
```
Or multiple rows:
```php
$query = parent::factory()
    ->insert('users')
    ->columns('username', 'password')
    ->values('sally', bcrypt('truck ice tiger'))
    ->values('mark', bcrypt('pop battery sound'))
    ->compile();

$query->sql(); // INSERT INTO "users" ("username", "password") VALUES (?, ?), (?, ?)
$query->params(); // ['sally', <hash>, 'mark', <hash>]
```
When using the Postgres engine RETURNING can be added:
```php
$query = parent::factory()
    ->insert('friends', [
        'user_id' => 11,
        'friend_id' => 30,
    ])
    ->returning('id')
    ->compile();

$query->sql(); // INSERT INTO "friends" ("user_id", "friend_id") VALUES (?, ?) RETURNING "id"
$query->params(); // [11, 30]
```
### when ecrypting password you may use Simply builtin function:
Make sure add this after the namespace in your model:
```php
Use function Simple\bcrypt;
```
You may use it like:
```php
 bcrypt('secret');
```
To verify:
use this in your model:
```php
use function Simple\bcrypt_verify;
```
then you may use:
```php
bcrypt_verify('secret', $password_hash) // replace params with your variables
//'secret' is the string to be verify
//'$password_hash' - is the generated hash using bcrypt();
```
## UPDATE
It is recommended to always include a WHERE statement:
```php
$query = parent::factory()
    ->update('places', [
        'address' => '555 Money Ave'
    ])
    ->where(field('name')->eq('work'))
    ->compile();

$query->sql(); // UPDATE "places" SET "address" = ? WHERE "name" = ?
$query->params(); // ['555 Money Ave', 'work']
```
## DELETE
It is recommended to always include a WHERE statement:
```php
$query = parent::factory()
    ->delete('users')
    ->where(field('login_at')->isNull())
    ->compile();

$query->sql(); // DELETE FROM "users" WHERE "login_at" IS NULL
$query->params(); // []
```
It is also possible to provide a LIMIT:
```php
$query = parent::factory()
    ->delete('users')
    ->limit(5)
    ->compile();

$query->sql(); // DELETE FROM "users" LIMIT 5
$query->params()
```
credits to: https://github.com/Wixel/GUMP
