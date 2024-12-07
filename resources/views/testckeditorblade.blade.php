@extends('layouts.dashboard.app')
@section('content')
    @push('jslive')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.2/es5/tex-mml-chtml.js"></script>

        <!-- تضمين مكتبة MathJax -->
       
        <script>
            // وظيفة لإضافة الرموز إلى الـ textarea
            function addSymbol(symbol) {
                const textarea = document.getElementById('equationInput');
                
                const cursorPos = textarea.selectionStart;
                const textBefore = textarea.value.substring(0, cursorPos);
                const textAfter = textarea.value.substring(cursorPos);
                textarea.value = textBefore + symbol + textAfter;
                textarea.focus();
                textarea.selectionEnd = cursorPos + symbol.length; // وضع المؤشر بعد الرمز
                updatePreview(); // تحديث العرض
            }

            // وظيفة لتحديث العرض باستخدام MathJax
            function updatePreview() {
                const textarea = document.getElementById('equationInput');
                const preview = document.getElementById('mathPreview');
                let text = textarea.value;

                // التحقق إذا كان التبديل مفعلًا لتحويل الأرقام
                const isArabicNumbers = document.getElementById('arabicNumbers').checked;
                if (isArabicNumbers) {
                   
                    text = convertToArabicNumbers(text);
                      //textarea.style.direction = 'rtl';
                    //textarea.style.textAlign = 'right';
                    //textarea.placeholder = 'أدخل معادلتك هنا...';
                   
                }else{
                    // textarea.style.direction = 'ltr';
                   // textarea.style.textAlign = 'left';
                   // textarea.placeholder = 'أدخل معادلتك هنا...';
               
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
                const textarea = document.getElementById('equationInput');
                textarea.addEventListener('input', updatePreview); // استدعاء تحديث العرض عند الكتابة

                // إضافة حدث عند تغيير حالة التبديل
                const toggleSwitch = document.getElementById('arabicNumbers');
                toggleSwitch.addEventListener('change', updatePreview);
            });
        </script>
    @endpush

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
                                onclick="addSymbol('\\sqrt{}')" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Square Root (√)">
                                √
                            </button>
                            <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                                onclick="addSymbol('\\frac{}{}')" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Fraction (⅟)">
                                ⅟
                            </button>
                            <button type="button" class="me-1 mb-1 btn btn-outline-secondary" onclick="addSymbol('^2')"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Power of 2 (x²)">
                                x²
                            </button>
                            <button type="button" class="me-1 mb-1 btn btn-outline-secondary" onclick="addSymbol('_{}')"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Subscript (x₂)">
                                x₂
                            </button>
                            <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                                onclick="addSymbol('\\int_{}^{}')" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Integral (∫)">
                                ∫
                            </button>
                            <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                                onclick="addSymbol('\\sum_{}^{}')" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Summation (Σ)">
                                Σ
                            </button>
                            <button type="button" class="me-1 mb-1 btn btn-outline-secondary" onclick="addSymbol('^{}')"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Superscript">
                                أسس لحرف
                            </button>
                            <button type="button" class="me-1 mb-1 btn btn-outline-secondary"
                                onclick="addSymbol('\\space')" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Space">
                                مسافة
                            </button>
                        </div>

                        <!-- حقل النص -->
                        <textarea id="equationInput" rows="4" class="mb-3 form-control" style="direction: ltr; text-align: left;"
                            placeholder="أدخل المعادلة هنا..."></textarea>

                        <!-- زر التبديل -->
                        <div class="mb-3 form-check form-switch">
                            <input type="checkbox" id="arabicNumbers" class="form-check-input">
                            <label for="arabicNumbers" class="form-check-label">ارقام عربى</label>
                        </div>

                        <!-- معاينة MathJax -->
                        <div class="mb-3">
                            <h5>Preview:</h5>
                            <div style="direction: ltr;">
                            <span  id="mathPreview" class="content-span" style="display: inline; font-family: Cairo, sans-serif, &quot;Noto Sans Arabic&quot;; width: 100%;">$$</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- أزرار التذييل -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
