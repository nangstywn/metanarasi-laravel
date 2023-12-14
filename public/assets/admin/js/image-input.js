// Image Input
// demo: https://codepen.io/azzalfauzi/pen/bGNbeRV
function ImageInput(element) {
    // Variables
    var $wrapper = element;
    var $file = $wrapper.querySelector('input[type=file]');
    var $input = $wrapper.querySelector('input[type=hidden]');
    var $img = $wrapper.querySelector('img');
    var maxSize = Number($file.getAttribute('max-size'));
    var types = $file.accept.split(',');

    var api = {
        onInvalid: onInvalid,
        onChanged: onChanged,
        afterChanged: null,
    };

    // Methods
    function fileHandler(e) {
        var file = $file.files.length && $file.files[0];

        if (!file) return;

        var errors = checkValidity(file);

        if (errors) {
            api.onInvalid(errors);
            $file.value = null;
            return;
        }

        api.onChanged(file, update, $wrapper)
    }

    function removeHandler(e) {
        if(e.target.classList.contains('image-remove')) {
            e.preventDefault(); 
            e.target.closest('.image-input').remove()
        }
    }

    function humanizeFormat(string) {
        return string.replace(/.*?\//, '');
    }

    function checkValidity(file) {
        var errors = [];

        types.includes(file.type) || errors.push('Format file harus: ' + types.map(humanizeFormat).join(', '));
        file.size < maxSize || errors.push('Ukuran file maksimal ' + maxSize / 1000000 + 'MB');

        return errors.length ? errors : false;
    }

    function getFileData(file, callback) {
        var reader = new FileReader();

        reader.addEventListener("load", function () {
            callback(reader.result);
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    function update(data) {
        $img.src = data;
        $input.value = data;
    }

    function onInvalid(errors) {
        console.log('.onInvalid called');
        alert(errors.join('. '));
    }

    function onChanged(file, update, $wrapper) {
        console.log('.onChanged called');
        getFileData(file, update);
        api.afterChanged && api.afterChanged(file, $wrapper);
    }

    // Init
    $wrapper.addEventListener("click", removeHandler, true);
    $file.addEventListener('change', fileHandler);

    return api;
};