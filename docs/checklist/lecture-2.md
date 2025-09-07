# Database Management using CI4
## Migration -> Seeding -> Truncate*

[ ] 1. Migration
- [ ] Check in Docker is MySQL is working,
    - [ ] You can run phpmyadmin if you want a interface/GUI
    - [ ] Or add this docker command and change the `<SQL Command>`
```cmd
docker compose exec -T mysql mysql -uroot -proot app -N -e "<SQL Command>"

example

docker compose exec -T mysql mysql -uroot -proot app -N -e "SHOW TABLES;"
```
- [ ] Create `Issue` named Users Table, can add description if you want to.
- [ ] Create `Branch` name it `database/users`
- [ ] Add new `Migration` named `CreateUsersTable` using command found on templates(requires php and composer) readme or coding your own, if you code your own the format name is, `YYYY-MM-DD-XXXXXX_Name`.
> Y = Year, M = Month Number, D = Day Number, X = any number of your choice, then migration name example `CreateUsersTable`
```php
// Migration template
class MigrationName extends Migration
{
    public function up()
    {
        // code
    }

    public function down()
    {
        // code
    }
}
```
- [ ] Making a table inside up
    - [ ] Add fields
        ```php
            $this->forge->addField([
                'column_name' => [
                    'type'           => 'INT',  // important
                    'constraint'     => 11,     // important, but some doesnt need this
                    'unsigned'       => true,   // optional
                    'auto_increment' => true,   // optional if you want auto counting, but important for the id
                    'null'           => false,  // not needed for id, but needed for most
                    'default'        => 1,      // optional
                ]
            ])
        ```
    - [ ] Always have
        ```php
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ```
    - [ ] Add Primary key
        ```php
            $this->forge->addKey('name_of_the_column_you_want_as_primary_key', true);
        ```
    - [ ] Add Unique key constraint
        ```php
            $this->forge->addUniqueKey('name_of_the_column_you_want_constraint');
        ```
    - [ ] Adding its table name
        ```php
            $this->forge->createTable('table_name_here', true);
        ```
- [ ] Dropping a table inside down
    ```php
        $this->forge->dropTable('table_name_here', true);
    ```
- [ ] Run `Migration` command you can check the readme, it doesnt require composer or php
- [ ] If no error you can check if the `migration` table has the name of the migration file you created and if the table exists
    - if migration exist but no table means format is in correct
- [ ] Once all working you can start adding your `label` in your source control.
    - [ ] Since we created Users Table. We could say we added a new feature
```bash
feat(user table): Added a migration for users table
```
- [ ] Start `pushing` directly to the `branch` in `stagged`. If any changes is needed then add another `push`.
- [ ] Once satisfied a `publish` or `sync`, click it to push from `stagged` to the `remote`
- [ ] Once in `remote` you can create `PR` or `Pull Request`.
    - [ ] Make sure `PR` is from your completed branch which this time is `database/users` and going to `development`
- [ ] Once `PR` is created if there is other member who need to review it you can set them to review and click `merge` if all goods, else you can comment and provide feedback.

[ ] 2. Seeding
- [ ] Create `Issue` named Users Table Seeding, can add description if you want to.
- [ ] Same `Branch`, `database/users`
- [ ] Add new `Seed` named `UsersSeeder` using command found on templates(requires php and composer) readme or coding your own
- [ ] Making contents of seeder
    ```php
        <?php

        namespace App\Database\Seeds;

        use CodeIgniter\Database\Seeder;

        class NameOfSeeder extends Seeder
        {
            $now = date('Y-m-d H:i:s');
            <!-- if you want password that is hashed -->
            $password = password_hash('Password123!', PASSWORD_DEFAULT);

            public function run()
            {
                <!-- no need to add id since its auto increment -->
                $dataYouWannaInsert = [
                    [
                        'column_1' => 'data_1',
                        'column_2' => 'data_2',
                        'column_3' => 'data_3',
                        'column_4' => 'data_4',
                        'column_5' => 'data_5',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                    [
                        'column_1' => 'data_1',
                        'column_2' => 'data_2',
                        'column_3' => 'data_3',
                        'column_4' => 'data_4',
                        'column_5' => 'data_5',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                ]
            }
        }
    ```
- [ ] Update `DatabaseSeeder.php` adding our newly created seeder
    - [ ] revise the following format after the first call
        ```php
            $this->call('App\\Database\\Seeds\\NameOfYourSeederHere');
        ```
- [ ] Run `Seed` command you can check the readme, it doesnt require composer or php
- [ ] If no error you can check if the table has the value you added in the seed
- [ ] Once all working you can start adding your `label` in your source control.
    - [ ] Since we created Users Table Seeder. We could say we added a new feature
```bash
feat(user table seeder): Added a seeder for users table
```
- [ ] Start `pushing` directly to the `branch` in `stagged`. If any changes is needed then add another `push`.
- [ ] Once satisfied a `publish` or `sync`, click it to push from `stagged` to the `remote`
- [ ] Once in `remote` you can create `PR` or `Pull Request`.
    - [ ] Make sure `PR` is from your completed branch which this time is `database/users` and going to `development`
- [ ] Once `PR` is created if there is other member who need to review it you can set them to review and click `merge` if all goods, else you can comment and provide feedback.

[ ] 3. Wrapping Up
- [ ] Test truncate if all data inside the table is gone
- [ ] Test your development branch
- [ ] Make PR to `main`/`master` branch then `merge`

## Activity time
Create the following, with their own issues, branches and PR
- [ ] Create a Login in Page
- [ ] Create a Sign up Page
- [ ] Dashboard A and B

## Backend Time
[ ] 1. Models and Entity
[ ] 2. Updating Controller and Route
[ ] 3. Wiring up frontend to backend
- from post,patch,put
- from db
- returns

