@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Login</h2>

        <div id="error" class="text-red-600 mb-4 hidden"></div>
        <div id="success" class="text-green-600 mb-4 hidden"></div>

        <form id="loginForm">
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 border rounded-lg bg-white" />
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border rounded-lg bg-white" />
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Login 
            </button>
        </form>
    </div>
</div>

    <style>
        /* Apply color changes only in dark mode */
        @media (prefers-color-scheme: dark) {
            /* Force input text color to black in dark mode */
            input[type="text"],
            input[type="number"],
            input[type="email"],
            input[type="password"],
            textarea,
            select {
                color: #000000 !important;
            }

            /* Ensure input placeholder text is visible in dark mode */
            input[type="text"]::placeholder,
            input[type="number"]::placeholder,
            input[type="email"]::placeholder,
            input[type="password"]::placeholder,
            textarea::placeholder {
                color: #666666 !important;
            }

            /* Force headings, labels, p, a, and span text to black in dark mode */
            h1:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            h2:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            h3:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            h4:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            h5:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            h6:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            label:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            p:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            a:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]),
            span:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]) {
                color: #000000 !important;
            }

            /* Force button text to black in dark mode (unless it has explicit text color class) */
            button:not([class*="text-red"]):not([class*="text-blue"]):not([class*="text-green"]):not([class*="text-yellow"]):not([class*="text-purple"]):not([class*="text-pink"]):not([class*="text-orange"]):not([class*="text-gray"]):not([class*="text-black"]):not([class*="text-[#"]) {
                color: #000000 !important;
            }

            /* Override white and cream colors in dark mode */
            h1[class*="text-white"],
            h2[class*="text-white"],
            h3[class*="text-white"],
            h4[class*="text-white"],
            h5[class*="text-white"],
            h6[class*="text-white"],
            label[class*="text-white"],
            p[class*="text-white"],
            a[class*="text-white"],
            span[class*="text-white"],
            button[class*="text-white"],
            h1[class*="text-cream"],
            h2[class*="text-cream"],
            h3[class*="text-cream"],
            h4[class*="text-cream"],
            h5[class*="text-cream"],
            h6[class*="text-cream"],
            label[class*="text-cream"],
            p[class*="text-cream"],
            a[class*="text-cream"],
            span[class*="text-cream"],
            button[class*="text-cream"],
            h1[style*="color: white"],
            h2[style*="color: white"],
            h3[style*="color: white"],
            h4[style*="color: white"],
            h5[style*="color: white"],
            h6[style*="color: white"],
            label[style*="color: white"],
            p[style*="color: white"],
            a[style*="color: white"],
            span[style*="color: white"],
            button[style*="color: white"],
            h1[style*="color: #fff"],
            h2[style*="color: #fff"],
            h3[style*="color: #fff"],
            h4[style*="color: #fff"],
            h5[style*="color: #fff"],
            h6[style*="color: #fff"],
            label[style*="color: #fff"],
            p[style*="color: #fff"],
            a[style*="color: #fff"],
            span[style*="color: #fff"],
            button[style*="color: #fff"],
            h1[style*="color: #ffffff"],
            h2[style*="color: #ffffff"],
            h3[style*="color: #ffffff"],
            h4[style*="color: #ffffff"],
            h5[style*="color: #ffffff"],
            h6[style*="color: #ffffff"],
            label[style*="color: #ffffff"],
            p[style*="color: #ffffff"],
            a[style*="color: #ffffff"],
            span[style*="color: #ffffff"],
            button[style*="color: #ffffff"],
            h1[style*="color: #fefefe"],
            h2[style*="color: #fefefe"],
            h3[style*="color: #fefefe"],
            h4[style*="color: #fefefe"],
            h5[style*="color: #fefefe"],
            h6[style*="color: #fefefe"],
            label[style*="color: #fefefe"],
            p[style*="color: #fefefe"],
            a[style*="color: #fefefe"],
            span[style*="color: #fefefe"],
            button[style*="color: #fefefe"],
            h1[style*="color: #f5f5f5"],
            h2[style*="color: #f5f5f5"],
            h3[style*="color: #f5f5f5"],
            h4[style*="color: #f5f5f5"],
            h5[style*="color: #f5f5f5"],
            h6[style*="color: #f5f5f5"],
            label[style*="color: #f5f5f5"],
            p[style*="color: #f5f5f5"],
            a[style*="color: #f5f5f5"],
            span[style*="color: #f5f5f5"],
            button[style*="color: #f5f5f5"] {
                color: #000000 !important;
            }
        }
    </style>

    <script>
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ url("/login") }}',
                type: 'POST',
                data: {
                    email: $('#email').val(),
                    password: $('#password').val(),
                    _token: '{{ csrf_token() }}'
                },
                xhrFields: {
                    withCredentials: true // important for session
                },
                success: function (response) {
                    $('#success').text(response.message).removeClass('hidden');
                    $('#error').addClass('hidden');

                    // Redirect after login
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1000);
                },
                error: function (xhr) {
                    $('#error').text(xhr.responseJSON.message || 'Login failed.').removeClass('hidden');
                    $('#success').addClass('hidden');
                }
            });
        });
    </script>
@endsection


    