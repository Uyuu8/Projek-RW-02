<!-- jQuery -->
<script src="{{ asset('Assets/Frontend/js/jquery-2.2.4.min.js') }}"></script>
<!-- OrgChart JS -->
<script src="{{ asset('orgchart/jquery.orgchart.js') }}"></script>
<!-- Plugins js -->
<script src="{{asset('Assets/Frontend/js/plugins.js')}}" type="text/javascript"></script>
<!-- Bootstrap js -->
<script src="{{asset('Assets/Frontend/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- WOW JS -->
<script src="{{asset('Assets/Frontend/js/wow.min.js')}}"></script>
<!-- Nivo slider js -->
<script src="{{asset('Assets/Frontend/vendor/slider/js/jquery.nivo.slider.js')}}" type="text/javascript"></script>
<script src="{{asset('Assets/Frontend/vendor/slider/home.js')}}" type="text/javascript"></script>
<!-- Owl Cauosel JS -->
<script src="{{asset('Assets/Frontend/vendor/OwlCarousel/owl.carousel.min.js')}}" type="text/javascript"></script>
<!-- Meanmenu Js -->
<script src="{{asset('Assets/Frontend/js/jquery.meanmenu.min.js')}}" type="text/javascript"></script>
<!-- Srollup js -->
<script src="{{asset('Assets/Frontend/js/jquery.scrollUp.min.js')}}" type="text/javascript"></script>
<!-- jquery.counterup js -->
<script src="{{asset('Assets/Frontend/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('Assets/Frontend/js/waypoints.min.js')}}"></script>
<!-- Select2 Js -->
<script src="{{asset('Assets/Frontend/js/select2.min.js')}}" type="text/javascript"></script>
<!-- Countdown js -->
<script src="{{asset('Assets/Frontend/js/jquery.countdown.min.js')}}" type="text/javascript"></script>
<!-- Isotope js -->
<script src="{{asset('Assets/Frontend/js/isotope.pkgd.min.js')}}" type="text/javascript"></script>
<!-- Magic Popup js -->
<script src="{{asset('Assets/Frontend/js/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>
<!-- Gridrotator js -->
<script src="{{asset('Assets/Frontend/js/jquery.gridrotator.js')}}" type="text/javascript"></script>
<!-- Custom Js -->
<script src="{{asset('Assets/Frontend/js/main.js')}}" type="text/javascript"></script>

<!-- OrgChart JS -->
<script src="{{ asset('orgchart/jquery.orgchart.js') }}"></script>
<script>
    $(document).ready(function() {
        var datascource = {
            'name': 'Prof. Reini Wirahadikusumah Ph.D',
            'title': 'Rektor ITB',
            'avatar': '{{ asset("images/Rektor.jpg") }}',
            'children': [
                {
                    'name': 'Prof. Dr. Jaka Sembiring',
                    'title': 'Wakil Rektor',
                    'avatar': '{{ asset("images/Wakil.jpg") }}',
                    'children': [
                        {
                            'name': 'Dr. Sigit Saptoyo, M.Si',
                            'title': 'Direktur',
                            'avatar': '{{ asset("images/Direktur.jpg") }}',
                            'children': [
                                {
                                    'name': 'Ridho Firmansyah, A.Md',
                                    'title': 'Kasubdit 1',
                                    'avatar': '{{ asset("images/Kasubditbeasiswa.jpg") }}',
                                    'children': [
                                        { 'name': 'Staff 1A', 'title': 'Staff', 'avatar': '{{ asset("images/1.jpg") }}' },
                                        { 'name': 'Staff 1B', 'title': 'Staff', 'avatar': '{{ asset("images/2.jpg") }}' }
                                    ]
                                },
                                {
                                    'name': 'Verni Gunawan, A.Md',
                                    'title': 'Kasubdit 2',
                                    'avatar': '{{ asset("images/Kasubditormawa.jpg") }}',
                                    'children': [
                                        { 'name': 'Staff 2A', 'title': 'Staff', 'avatar': '{{ asset("images/3.jpg") }}' },
                                        { 'name': 'Staff 2B', 'title': 'Staff', 'avatar': '{{ asset("images/4.jpg") }}' }
                                    ]
                                },
                                // Tambahkan anak-anak lainnya...
                            ]
                        }
                    ]
                }
            ]
        };

        $('#chart-container').orgchart({
            'data': datascource,
            'nodeContent': 'title',
            'pan': true,
            'zoom': true,
            'zoominLimit': 2,
            'zoomoutLimit': 0.5,
            'nodeTemplate': function(data) {
                return `
                    <div class="title">${data.name}</div>
                    <div class="content">${data.title}</div>
                    <img class="avatar" src="${data.avatar}" alt="Avatar">`;
            }
        });
    });
</script>

