@props([
    'id' => '',
    'value' => '',
])

<!-- تضمين مكتبة MathJax -->
<script>
    // وظيفة لحفظ المعادلة
    function saveEquation(id) {

        const textarea = document.getElementById('equationInput_' + id);
        let equation = textarea.value;

        // التحقق إذا كان التبديل مفعلًا لتحويل الأرقام
        const isArabicNumbers = document.getElementById('arabicNumbers_' + id).checked;
        if (isArabicNumbers) {
            // تحويل الأرقام إلى الأرقام العربية
            equation = convertToArabicNumbers(equation);
        }

        const editor = CKEDITOR.instances[id];
        editor.insertHtml(equation); // إدخال المعادلة إلى المحرر باستخدام CKEditor


        // إغلاق الـ Modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('equationModal_' + id));
        modal.hide();
    }

    // وظيفة لإضافة الرموز إلى الـ textarea
    function addSymbol(symbol, id) {
        const textarea = document.getElementById('equationInput_' + id);
        const cursorPos = textarea.selectionStart;
        const textBefore = textarea.value.substring(0, cursorPos);
        const textAfter = textarea.value.substring(cursorPos);
        textarea.value = textBefore + symbol + textAfter;
        textarea.focus();
        textarea.selectionEnd = cursorPos + symbol.length; // وضع المؤشر بعد الرمز
        updatePreview(id); // تحديث العرض الخاص بكل محرر
    }

    // وظيفة لتحديث المعاينة ومعالجة النصوص
    function updatePreview(id) {
        const textarea = document.getElementById('equationInput_' + id);
        const preview = document.getElementById('mathPreview_' + id);
        let text = textarea.value;

        // التحقق إذا كان التبديل مفعلًا لتحويل الأرقام
        const isArabicNumbers = document.getElementById('arabicNumbers_' + id).checked;

        if (isArabicNumbers) {
            // تحويل الأرقام إلى الأرقام العربية فقط
            text = convertToArabicNumbers(text);

            // تحديث النص في CKEditor بعد تحويل الأرقام إلى العربية
           // const editor = CKEDITOR.instances[id];
            //editor.setData(text); // تحديث المحتوى في CKEditor
        }

        // تحديث المعاينة في MathJax مع تحويل النص
        preview.innerHTML = `\\[${text}\\]`; // عرض المعادلة مع صيغة MathJax
        MathJax.typesetPromise([preview]); // إعادة تفسير النصوص باستخدام MathJax
    }

    // تحويل الأرقام الإنجليزية إلى الأرقام العربية
    function convertToArabicNumbers(input) {
        const arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return input.replace(/\d/g, (digit) => arabicNumbers[digit]);
    }

    // إضافة حدث عند تغيير حالة التبديل
    document.addEventListener('DOMContentLoaded', () => {
        const textarea = document.getElementById('equationInput_' + '{{ $id }}');

        // عند الكتابة داخل textarea
        textarea.addEventListener('input', () => updatePreview('{{ $id }}'));

        // عند تغيير حالة التبديل للتحويل إلى أرقام عربية
        const toggleSwitch = document.getElementById('arabicNumbers_' + '{{ $id }}');
        toggleSwitch.addEventListener('change', () => updatePreview('{{ $id }}'));
    });
</script>

<div wire:ignore>
    <textarea {{ $attributes->wire('model') }} class="form-control" id="{{ $id }}"
        placeholder="Enter the Description" rows="5" name="body">{{ $value }}</textarea>

</div>
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
    data-bs-target="#equationModal_{{ $id }}">
    اضافة معادلة
</button>

<!-- مودال المعادلة الرياضية -->
<div wire:ignore.self class="modal fade" id="equationModal_{{ $id }}" tabindex="-3"
    aria-labelledby="equationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="equationModalLabel">Enter Equation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-left">
                    <!-- أزرار الرموز الرياضية -->
                    <div class="mb-2 position-relative">
                        <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                            onclick="addSymbol('\\sqrt{}', '{{ $id }}')" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Square Root (√)">√</button>
                        <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                            onclick="addSymbol('\\frac{}{}', '{{ $id }}')" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Fraction (⅟)">⅟</button>
                        <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                            onclick="addSymbol('^2', '{{ $id }}')" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Power of 2 (x²)">x²</button>
                        <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                            onclick="addSymbol('_{}', '{{ $id }}')" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Subscript (x₂)">x₂</button>
                        <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                            onclick="addSymbol('\\int_{}^{}', '{{ $id }}')" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Integral (∫)">∫</button>
                        <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                            onclick="addSymbol('\\sum_{}^{}', '{{ $id }}')" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Summation (Σ)">Σ</button>
                        <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                            onclick="addSymbol('^{}', '{{ $id }}')" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Superscript">أسس لحرف</button>
                        <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                            onclick="addSymbol('\\space', '{{ $id }}')" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Space">مسافة</button>
                    </div>

                    <!-- حقل النص -->
                    <textarea id="equationInput_{{ $id }}" rows="4" class="mb-3 form-control"
                        style="direction: ltr; text-align: left;" placeholder="أدخل المعادلة هنا...">{{ $value }}</textarea>


                    <div class="mb-3 form-check form-switch">
                        <input type="checkbox" id="arabicNumbers_{{ $id }}" class="form-check-input">
                        <label for="arabicNumbers_{{ $id }}" class="form-check-label">ارقام عربى</label>
                    </div>

                    <!-- معاينة MathJax -->
                    <div class="mb-3">
                        <h5>Preview:</h5>
                        <div wire:ignore style="direction: ltr;">
                            <span wire:ignore id="mathPreview_{{ $id }}" class="content-span"
                                style="display: inline; font-family: Cairo, sans-serif, &quot;Noto Sans Arabic&quot;; width: 100%;"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveEquation('{{ $id }}')">Save
                    Equation</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    var currentLocale = '{{ LaravelLocalization::getCurrentLocale() }}';

    document.addEventListener('DOMContentLoaded', function() {
        //CKEDITOR.plugins.addExternal('ckeditor_wiris', 'https://www.wiris.net/demo/plugins/ckeditor/','plugin.js');
        CKEDITOR.editorConfig = function(config) {
            config.allowedContent = true;
            config.versionCheck = false;
            config.contentsCss = ['body { font-family: "Cairo", sans-serif; }'];
            config.image2_alignClasses = ['image-align-left', 'image-align-center', 'image-align-right'];
            config.image2_disableResizer = false;
        };
        const editor = CKEDITOR.replace(document.querySelector('#{{ $id }}'), {
            //  extraPlugins: 'ckeditor_wiris'
        });
        // Bind CKEditor changes to Livewire property
        editor.on('change', function() {
            @this.set('{{ $attributes->wire('model')->value() }}', editor.getData());
        });
        editor.setData(@json($value));
    });

    // Ensure CKEditor is initialized with any existing value
</script>
