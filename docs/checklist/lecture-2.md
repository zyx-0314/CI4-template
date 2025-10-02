# Database Management using CI4
## Migration -> Seeding -> Truncate*

[ ] 1. Migration
- [ ] Make sure that you copy the .env.sample
- [ ] Rename `.env copy.sample` -> `.env`
- [ ] Check in Docker is MySQL is working,
    - [ ] You can run phpmyadmin if you want a interface/GUI
    - [ ] Or add this docker command and change the `<SQL Command>`
        ```cmd
        docker compose exec -T mysql mysql -uroot -proot app -N -e "<SQL Command>"

        example

        docker compose exec -T mysql mysql -uroot -proot app -N -e "SHOW TABLES;"
        ```
- [ ] Create `Issue` named Users Table, can add description if you want to.
- [ ] Create `Branch` name it `database/users`. make sure that you are in right branch looking at the bottom left you should see `frontend/loginPage` not `main`, `frontend/landingPage`, `development`
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
                    'constraint'     => 11,     // important, but some doesnt need this. this is used to control the bit size
                    'unsigned'       => true,   // optional, it means all positive value
                    'auto_increment' => true,   // optional if you want auto counting, but important for the id
                    'null'           => false,  // not needed for id, but needed for most, it means it can be empty
                    'default'        => 1,      // optional, used if you want to have default value
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
            <!-- Soft Delete -->
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ```
    - Example:
        ```php
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'middle_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'password_hash' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'client',
                'null'       => false,
            ],
            'account_status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1, // 1 = active, 0 = inactive
                'null'       => false,
            ],
            'email_activated' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
                'null'       => false,
            ],
            'newsletter' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'null'       => false,
            ],
            'gender' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            // You use Var Char for images directory
            'profile_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        ```
    - [ ] Add Primary key
        ```php
            $this->forge->addKey('name_of_the_column_you_want_as_primary_key', true);
        ```
    - [ ] Add Unique key constraint, this is optional
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

[ ] 2. Seeding
- [ ] Create `Issue` named Users Table Seeding, can add description if you want to.
- [ ] Using same `Branch`, `database/users`. make sure that you are in right branch looking at the bottom left you should see `frontend/loginPage` not `main`, `frontend/landingPage`, `development`
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
- [ ] Make sure to have the files of `DatabaseSeeder.php` and `ClearDatabaseSeeder.php`
- [ ] Update `DatabaseSeeder.php` adding our newly created seeder
    - [ ] revise the following format after the first call
        ```php
            $this->call('App\\Database\\Seeds\\NameOfYourSeederHere');
        ```
- [ ] Update `ClearDatabaseSeeder.php` adding our newly created table
    - [ ] revise the following format after the first call
        ```php
            <!-- Add the table name inside example "User" Table -->
            $tablesInOrder = ['User'];
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
- [ ] Dashboard Admin
- [ ] Services Page (or something similar name)
- [ ] Accounts Page
- [ ] Request Page (or something similar)

## Backend Time
[ ] 1. Model and Entity
- [ ] Create `Issue` named Users Model and Entity, can add description if you want to.
- [ ] Create `Branch` name it `backend/users`
- [ ] Add new `Model` named `UsersModel` using command found on templates(requires php and composer) readme or coding your own.
- [ ] Modifying Model
    ```php
    <!-- Template -->
    <?php

    namespace App\Models;

    use CodeIgniter\Model;

    class ModelNameDito extends Model
    {
        protected $table            = 'tableNameHere';
        protected $primaryKey       = 'id';
        protected $useAutoIncrement = true;
        protected $returnType       = 'array';
        protected $useSoftDeletes   = true;
        protected $protectFields    = true;
        protected $allowedFields    = [];

        protected bool $allowEmptyInserts = false;
        protected bool $updateOnlyChanged = true;

        protected array $casts = [];
        protected array $castHandlers = [];

        // Dates
        protected $useTimestamps = false;
        protected $dateFormat    = 'datetime';
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        // Validation
        protected $validationRules      = [];
        protected $validationMessages   = [];
        protected $skipValidation       = false;
        protected $cleanValidationRules = true;

        // Callbacks
        protected $allowCallbacks = true;
        protected $beforeInsert   = [];
        protected $afterInsert    = [];
        protected $beforeUpdate   = [];
        protected $afterUpdate    = [];
        protected $beforeFind     = [];
        protected $afterFind      = [];
        protected $beforeDelete   = [];
        protected $afterDelete    = [];
    }
    ```
- [ ] Modifications
    - [ ] Change `returnType` to entity making match data structure of db and return data
        - from `'array'` to `'\App\\Entities\\User'`. in this we are using `User`
    - [ ] Change `allowedFields` to the structure of db except `['created_at', 'updated_at', 'deleted_at']` case those exist in the `Entity`
- [ ] Add new `Entity` named `User` using command found on templates(requires php and composer) readme or coding your own.
- [ ] Modifying Entity
    ```php
    <?php

    namespace App\Entities;

    use CodeIgniter\Entity\Entity;

    class NameOfEntity extends Entity
    {
        protected $datamap = [];
        protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
        protected $casts   = [];
    }
    ```
- [ ] Once all done you can start adding your `label` in your source control.
    - [ ] Since we created Model and Entity. We could say we added a new feature
        ```bash
        feat: Added a Enity and Model
        ```
- [ ] Start `pushing` directly to the `branch` in `stagged`. If any changes is needed then add another `push`.
- [ ] Once satisfied a `publish` or `sync`, click it to push from `stagged` to the `remote`
- [ ] Once in `remote` you can create `PR` or `Pull Request`.
    - [ ] Make sure `PR` is from your completed branch which this time is `backend/users` and going to `development`
- [ ] Once `PR` is created if there is other member who need to review it you can set them to review and click `merge` if all goods, else you can comment and provide feedback.

[ ] 2. Updating Controller and Route
- [ ] Create `Issue` named Functions for Login, can add description if you want to.
- [ ] Using same `Branch`, `backend/users`. make sure that you are in right branch looking at the bottom left you should see `frontend/loginPage` not `main`, `frontend/landingPage`, `development`
- [ ] Update `Controller` to add certain functions
    - [ ] Login:
        - [ ] Create `login` function
            ```php
                public function login() {}
            ```
        - [ ] Start a Session
            ```php
                $session = session();
            ```
        - [ ] Create Validation Rules. This depends on your logic
            ```php
                <!-- Here i created rules for email and password -->
                $validation = \Config\Services::validation();
                <!-- Variable comes from the htnm the id from the input -->
                <!-- Format: variable, human readable name, rules seperated by | -->
                <!-- So this following rule means variable email is Email which means it should not be null and has valid email format -->
                $validation->setRule('email', 'Email', 'required|valid_email');
                <!-- The following rule means variable password, ma,ed Password and it should not be null -->
                $validation->setRule('password', 'Password', 'required');

                <!-- Other Rules -->
                min_length[]
                max_length[]
                permit_empty
                matches[<variable name here>]
            ```
        - [ ] Transfer post data to variable
            ```php
                $post = $request->getPost();
            ```
        - [ ] If validation of data `email` and `password` are not valid then trigger to return the input in variable to input element in html and set validation error message
            ```php
                if (! $validation->run($post)) {
                    $session->setFlashdata('errors', $validation->getErrors());
                    $session->setFlashdata('old', $post);
                    return redirect()->back()->withInput();
                }
            ```
        - [ ] Extract Email value to email variable
            ```php
                $email = $request->getPost('email');
            ```
        - [ ] Extract Email value to email variable
            ```php
                $email = $request->getPost('email');
            ```
        - [ ] Using model we will call the database and query
            ```php
                $userModel = new \App\Models\UsersModel();
                $user = $userModel->where('email', $email)->first();
            ```
        - [ ] Condition that there should be return value which means user is registered
            ```php
                if (! $user) {
                    $session->setFlashdata('errors', ['email' => 'No account found for that email']);
                    $session->setFlashdata('old', ['email' => $email]);
                    return redirect()->back()->withInput();
                }
            ```
        - [ ] Converting to useable array
            ```php
                $userArr = is_array($user) ? $user : (method_exists($user, 'toArray') ? $user->toArray() : (array) $user);
            ```
        - [ ] Condition to check using hash the password
            ```php
                if (! password_verify($request->getPost('password'), $userArr['password_hash'] ?? '')) {
                    $session->setFlashdata('errors', ['password' => 'Incorrect password']);
                    $session->setFlashdata('old', ['email' => $email]);
                    return redirect()->back()->withInput();
                }
            ```
        - [ ] Condition to check using hash the password
            ```php
                if (! password_verify($request->getPost('password'), $userArr['password_hash'] ?? '')) {
                    $session->setFlashdata('errors', ['password' => 'Incorrect password']);
                    $session->setFlashdata('old', ['email' => $email]);
                    return redirect()->back()->withInput();
                }
            ```
        - [ ] Create a session making sure the user is logged in
            ```php
                $session->set('user', [
                    'id' => $userArr['id'] ?? null,
                    'email' => $userArr['email'] ?? null,
                    'first_name' => $userArr['first_name'] ?? null,
                    'last_name' => $userArr['last_name'] ?? null,
                    'type' => $userArr['type'] ?? 'client',
                    'display_name' => trim(($userArr['first_name'][0] ?? '') . ' ' . ($userArr['middle_name'][0] ?? '') . ' ' . ($userArr['last_name'] ?? '')),
                ]);
            ```
        - [ ] Conditional return depends of the type of user
            ```php
                $type = strtolower($userArr['type'] ?? 'client');
                if ($type === 'manager') {
                    return redirect()->to('/admin/dashboard');
                }

                if ($type === 'client') {
                    return redirect()->to('/');
                }
            ```
- [ ] Update `Routes` to add certain end point
    - [ ] This time we use Post as we are recieving data
        ```php
            $routes->post('login', 'Auth::login');
        ```
> now you do the other functions with your own logics
- [ ] Logout
    - [ ] In `Controller`
        - [ ] Destroy from session.
            ```php
            session()->destroy();
            ```
        - [ ] Remove session
            ```php
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 3600, $params['path'] ?? '/', $params['domain'] ?? '', isset($_SERVER['HTTPS']), true);
            ```
        - [ ] Remove session
            ```php
            return redirect()->to('/');
            ```
    - [ ] In `Routes`
- [ ] Sign Up
    - [ ] In `Controller`
        - [ ] Create Session
        - [ ] Extract Data from frontend
            ```php
            $request = service('request');
            ```
        - [ ] Create Rules
        - [ ] Error Catchers, Conditions that if not followed will return error messages
        - [ ] If all is good now we create and use the data structure coming from model
            ```php
            $userModel = new \App\Models\UsersModel();
            ```
        - [ ] Now prepare your data. below is an example.
            ```php
            $data = [
                'first_name' => $post['first_name'],
                'middle_name' => $post['middle_name'] ?? null,
                'last_name' => $post['last_name'],
                'email' => $post['email'],
                'password_hash' => password_hash($post['password'], PASSWORD_DEFAULT),
                'type' => 'client',
                'account_status' => 1,
                'email_activated' => 0,
            ];
            ```
        - [ ] Now insert in the database
            ```php
            $inserted = $userModel->insert($data);
            ```
        - [ ] Redirect if success or not
    - [ ] In `Routes`
- [ ] Once all done you can start adding your `label` in your source control.
    - [ ] Since we updated Controller and Routes. We could say we added a new feature
        ```bash
        refactor(auth): Updated Auth Controller with following functions and expose Routes

        - Login = Auth::login
        - Logout = Auth::logout
        - Sign Up = Auth::signup
        ```
- [ ] Start `pushing` directly to the `branch` in `stagged`. If any changes is needed then add another `push`.
- [ ] Once satisfied a `publish` or `sync`, click it to push from `stagged` to the `remote`
    - [ ] Make sure `PR` is from your completed branch which this time is `backend/users` and going to `development`
- [ ] Once `PR` is created if there is other member who need to review it you can set them to review and click `merge` if all goods, else you can comment and provide feedback.

[ ] 3. Wiring up frontend to backend
- [ ] Create `Issue` named Wiring up frontend to backend, can add description if you want to.
- [ ] Using same `Branch`, `backend/users`. make sure that you are in right branch looking at the bottom left you should see `frontend/loginPage` not `main`, `frontend/landingPage`, `development`
- [ ] Updating the `Forms`. In `Login`
    ```php
        <!-- set actions to the endpoint name, this time /login -->
        <!-- set method to use, this time since we are sending data we are using `post` -->
        <form class="space-y-6 mt-8" action="/login" method="post" novalidate>
    ```
- [ ] Add data catchers, add at top
    ```php
        $errors = $errors ?? [];
        $old = $old ?? [];
    ```
- [ ] Wire up catchers to show in the UI
    ```php
        <input
            id="email"
            name="email"
            type="email"
            autocomplete="email"
            required
            value="<?= esc($old['email'] ?? '') ?>"
            aria-invalid="<?= isset($errors['email']) ? 'true' : 'false' ?>" aria-describedby="email-error"
        >
        <?php if (! empty($errors['email'])): ?>
            <p id="email-error" class="mt-2 text-red-600 text-sm"><?= esc($errors['email']) ?></p>
        <?php endif; ?>
    ```
- [ ] Now wireup the signup
- [ ] Now wireup the logout
- [ ] Once all done you can start adding your `label` in your source control.
    - [ ] Since we updated Controller and Routes. We could say we added a new feature
        ```bash
        refactor(auth): Wireup backend and frontend

        - Login, Logout and Sign up
        ```
- [ ] Start `pushing` directly to the `branch` in `stagged`. If any changes is needed then add another `push`.
- [ ] Once satisfied a `publish` or `sync`, click it to push from `stagged` to the `remote`
    - [ ] Make sure `PR` is from your completed branch which this time is `backend/users` and going to `development`
- [ ] Once `PR` is created if there is other member who need to review it you can set them to review and click `merge` if all goods, else you can comment and provide feedback.
