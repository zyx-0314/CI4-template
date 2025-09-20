# Add Assets from public to view
- [ ] Add assets in `public` folder
- [ ] Visit the page you want to use the assets
- [ ] Get the directory from public to the assets
    - example: the image in folder `logo` the `src="<?= base_url('logo/logo.svg') ?>"`
    - example: the js in folder `js` the `src="<?= base_url('js/toast.js') ?>"`

# How to use Toast
- [ ] Make sure you have the code: `backend\public\js\toast.js`
- [ ] Call it before other js: <script src="<?= base_url('js/toast.js') ?>"></script>
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