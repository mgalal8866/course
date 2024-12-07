@props([
    'id' => '',
    'value' => '',
])

<!-- تضمين مكتبة MathJax -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.2/es5/tex-mml-chtml.js"></script>
<script>
    // وظيفة لإضافة الرموز إلى الـ textarea
    function addSymbol(symbol, id) {
        const textarea = document.getElementById(id);

        const cursorPos = textarea.selectionStart;
        const textBefore = textarea.value.substring(0, cursorPos);
        const textAfter = textarea.value.substring(cursorPos);
        textarea.value = textBefore + symbol + textAfter;
        textarea.focus();
        textarea.selectionEnd = cursorPos + symbol.length; // وضع المؤشر بعد الرمز
        updatePreview(id); // تحديث العرض
    }

    // وظيفة لتحديث العرض باستخدام MathJax
    function updatePreview(id) {
        const textarea = document.getElementById(id);
        const preview = document.getElementById('mathPreview_' + id);
        let text = textarea.value;

        // التحقق إذا كان التبديل مفعلًا لتحويل الأرقام
        const isArabicNumbers = document.getElementById('arabicNumbers_' + id).checked;
        if (isArabicNumbers) {
            text = convertToArabicNumbers(text);
        }

        preview.innerHTML = `\\[${text}\\]`; // تحديث النص مع صيغة MathJax
        MathJax.typesetPromise([preview]); // إعادة تفسير النصوص باستخدام MathJax
    }

    // تحويل الأرقام الإنجليزية إلى الأرقام العربية
    function convertToArabicNumbers(input) {
        const arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return input.replace(/\d/g, (digit) => arabicNumbers[digit]);
    }

    // إضافة حدث التحديث عند إدخال نص في textarea
    document.addEventListener('DOMContentLoaded', () => {
        const textarea = document.getElementById('equationInput_' + '{{ $id }}');
        textarea.addEventListener('input', function () {
            updatePreview('{{ $id }}');
        });

        // إضافة حدث عند تغيير حالة التبديل
        const toggleSwitch = document.getElementById('arabicNumbers_' + '{{ $id }}');
        toggleSwitch.addEventListener('change', function () {
            updatePreview('{{ $id }}');
        });
    });
</script>

<div role="dialog" aria-modal="true" class="fade modal show" tabindex="-1" style="display: block;">
    <div dir="rtl" class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title h4">Enter Equation</div>
                <button type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-left">
                    <!-- أزرار الرموز الرياضية -->
                    <div class="mb-2 position-relative">
                        <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                            onclick="addSymbol('\\sqrt{}', '{{ $id }}')" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Square Root (√)">
                            √
                        </button>
                        <!-- أزرار الرموز الأخرى هنا -->
                    </div>

                    <!-- حقل النص -->
                    <textarea id="equationInput_{{ $id }}" rows="4" class="mb-3 form-control"
                        style="direction: ltr; text-align: left;" placeholder="أدخل المعادلة هنا...">{{ $value }}</textarea>

                    <!-- زر التبديل -->
                    <div class="mb-3 form-check form-switch">
                        <input type="checkbox" id="arabicNumbers_{{ $id }}" class="form-check-input">
                        <label for="arabicNumbers_{{ $id }}" class="form-check-label">ارقام عربى</label>
                    </div>

                    <!-- معاينة MathJax -->
                    <div class="mb-3">
                        <h5>Preview:</h5>
                        <div style="direction: ltr;">
                            <span id="mathPreview_{{ $id }}" class="content-span"
                                style="display: inline; font-family: Cairo, sans-serif, &quot;Noto Sans Arabic&quot;; width: 100%;">$$</span>
                        </div>
                    </div>

                    <!-- زر حفظ المعادلة -->
                    <button type="button" class="btn btn-primary" onclick="copyEquation('{{ $id }}')">Save Equation</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyEquation(id) {
        const textarea = document.getElementById('equationInput_' + id);
        const equation = textarea.value;
        // نسخ المعادلة للمحرر العلوي (المحرر الأعلى بالـ id)
        const targetEditor = document.getElementById('equationInput_' + id); // أو أي معرّف آخر
        targetEditor.value = equation; // نسخ المعادلة إلى المحرر
        updatePreview(id); // تحديث العرض
    }
</script>
