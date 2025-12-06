<!DOCTYPE html>
<html   lang="en" >

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
	@include('Backend.Partial.head')

	

	<title>IMM SULBAR</title>
</head>

<body class=" bg-surface">
	<main>
		<div class="app-topstrip z-40 sticky top-0 py-[15px] px-6 bg-[linear-gradient(90deg,_#0f0533_0%,_#1b0a5c_100%)]">
			
		</div>
		<!--start the project-->
		<div id="main-wrapper" class="flex p-5 xl:pr-0">
			<aside id="application-sidebar-brand"
				class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full  transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-[90px] xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0  w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar   transition-all duration-300" >
				@include('Backend.Partial.sidebar')
			</aside>
			<div class=" w-full page-wrapper xl:px-6 px-0">

				<!-- Main Content -->
				<main class="h-full  max-w-full">
					<div class="container full-container p-0 flex flex-col gap-6">
					<!--  Header Start -->
				<header class=" bg-white shadow-md rounded-md w-full text-sm py-4 px-6">
					@include('Backend.Partial.header')
				</header>
				<!--  Header End -->
                <div class="grid grid-cols-1 gap-6">
					<div>
						<div class="card">
							<div class="card-body">
								<div class="flex justify-between mb-5">

								</div>
								@yield('content')
								
							</div>
						</div>
					</div>
				</div>                   
					<footer>
						<p class="text-base text-gray-400 font-normal p-3 text-center">
						&#169; 2025 IMM Sulbar
						</p>
					</footer>
					</div>


				</main>
				<!-- Main Content End -->
				
			</div>
		</div>
		<!--end of project-->
	</main>


	@include('Backend.Partial.script')
	<script src="{{asset('admin/assets/node_modules/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/dashboard.js')}}"></script>

	<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

	<script>
	document.addEventListener("DOMContentLoaded", function () {
		document.querySelectorAll('.ckeditor').forEach((el) => {
			ClassicEditor
				.create(el)
				.catch(error => { console.error(error); });
		});
	});
	</script>


	<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // mencegah submit langsung
            const form = this.closest('form'); // ambil form terdekat
            const examName = this.getAttribute('data-name') || 'data ini';

            Swal.fire({
                title: 'Yakin ingin menghapus ' + examName + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submit form jika setuju
                }
            });
        });
    });
	</script>



	@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
</body>

</html>