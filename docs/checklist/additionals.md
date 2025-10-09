# Add Assets from public to view
- [ ] Add assets in `public` folder
- [ ] Visit the page you want to use the assets
- [ ] Get the directory from public to the assets
    - example: the image in folder `logo` the `src="/logo/logo.svg"`
    - example: the js in folder `js` the `src="/js/toast.js"`

# How to use Toast
- [ ] Make sure you have the code: `backend\public\js\toast.js`
- [ ] Call it before other js: <script src="/js/toast.js"></script>
- [ ] Inside your JS use it like this:
    ```js
        document.addEventListener('keydown', function(e) {
            <!-- toast(<the information>, <type>) -->
            if (e.key === 'Escape') toast('Escape is Clicked', 'info');
        });
    ```
> Note: it has success which is green, error which is red and other is blue

# Added a Dynamic Header
- file: `backend\app\Views\components\head.php`
- ✅ It has global Color Palette sample
- ✅ It has TailwindCSS Ready
- ✅ It has Font Awsome Ready
- ✅ It has Google Font Ready Sample

# Adding Email Sending
- [ ] Setup Email SMTP using gmail(Google as provider)
    - [ ] Go to `Email` under `Config`
    - [ ] Change `$protocol` value to `smtp`
    - [ ] Change `$SMTPHost` value to `smtp.gmail.com`
    - [ ] Change `$SMTPUser` value to `yourCompanyEmailHere+sender@gmail.com`
    - [ ] Change `$SMTPPass` value to App password
        - [ ] Creating App password
            - [ ] Login in Gmail
            - [ ] Go to https://myaccount.google.com/security-checkup
            - [ ] Switch `2-Step Verification` On. (Use SMS, Authenticator app, or a security key).
            - [ ] Go to https://myaccount.google.com/apppasswords
            - [ ] Add your Password and convert to App Password
            - [ ] Copy App Password
    - [ ] Change `$SMTPPort` value to `587`
    - [ ] Change `$mailType` value to `html`
- [ ] Using it in controller
    - [ ] Using `$email = \Config\Services::email();` will call the setuped data
    - [ ] Config Email to send:
        - [ ] Where its from: `$email->setFrom('noreply@<your business>.com', '<your business>');`
        - [ ] Send to: `$email->setTo($targetEmail);`
        - [ ] Subject Title: `$email->setSubject('<Email subject here example: Email Verification Code>');`
        - [ ] Subject Title: `$email->setMessage($message);`
            - [ ] Example: 
            ```php
                $verificationCode = 1234

                $message = "
                    <h2>Email Verification</h2>
                    <p>Your verification code is: <strong style='font-size: 24px; letter-spacing: 3px;'>{$verificationCode}</strong></p>
                    <p>This code will expire in 5 minutes.</p>
                    <p>If you did not request this verification, please ignore this email.</p>
                ";
            ```
    - [ ] Send it
        ```php
            if ($email->send()) {
                echo 'success';
            } else {
                echo 'failed';
            }
        ```

# Upload Image
- [ ] Catch data from the post
    - [ ] Depends on your data name
    ```php
        $request = service('request');
        <!-- I'm using banner_image in input name and id-->
        $file = $request->getFile('banner_image');
    ```
- [ ] Create try catch wrapping the whole logic. If it happens there is error we are catching the 
```php
    try {
        // code here
    } catch (\Exception $e) {
        return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
            ->setJSON(['success' => false, 'message' => 'Failed to process banner image']);
    }
```
- [ ] Verify if the data is valid and cached
```php
    if ($file && $file->isValid() && ! $file->hasMoved()) {
        // Code
    }
```
- [ ] Verify the type specifics and size
```php
    $allowed = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
    $mime = $file->getClientMimeType();

    // Check if valid image format
    if (! in_array($mime, $allowed)) {
        return $this->response->setStatusCode(ResponseInterface::HTTP_UNSUPPORTED_MEDIA_TYPE)
            ->setJSON(['success' => false, 'message' => 'Invalid image type']);
    }

    $maxBytes = 5 * 1024 * 1024;

    // Check if valid size
    if ($file->getSize() > $maxBytes) {
        return $this->response->setStatusCode(413)
            ->setJSON(['success' => false, 'message' => 'Image too large']);
    }
```
- [ ] Format Directory
    - [ ] For my directories I want it that based on `public` -> `uploads` -> `service` -> <year> -> <month> -> <file>
```php
    //  Format Directory
    $sub = date('Y') . DIRECTORY_SEPARATOR . date('m');
    $publicUploadDir = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR . $sub . DIRECTORY_SEPARATOR;
```
- [ ] Check if they file directory doesn't exist create the file
```php
    //  if the folder doesnt exist create it
    if (! is_dir($publicUploadDir)) mkdir($publicUploadDir, 0755, true);
```
- [ ] Create Random name
```php
    // Generate random name
    $newName = $file->getRandomName();
```
- [ ] Move it
```php
    // Move the file
    $moved = $file->move($publicUploadDir, $newName);
```
- [ ] Check if the file is move
```php
    // If successfully moved save the directory
    if ($moved) {
        $bannerImagePath = 'uploads/services/' . str_replace(DIRECTORY_SEPARATOR, '/', $sub) . '/' . $newName;
    }
```