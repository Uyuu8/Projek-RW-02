<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Chart</title>

    <!-- OrgChart CSS -->
    <link href="{{ asset('orgchart/jquery.orgchart.css') }}" rel="stylesheet">
    <style>
        #chart-container {
    width: 100%;
    height: calc(100vh - 150px); /* Hitung tinggi berdasarkan viewport dikurangi header/footer */
    border: 2px solid #aaa;
    text-align: center;
    overflow: auto;
}

        .orgchart {
            background: #fff;
            font-family: 'Arial', sans-serif;
        }
        .orgchart td.left, .orgchart td.right, .orgchart td.top {
            border-color: #ccc;
        }
        .orgchart .title {
            background-color: #1a73e8;
            color: white;
            font-weight: bold;
            padding: 5px;
            font-size: 1.1rem;
        }
        .orgchart .content {
            border-color: #1a73e8;
            font-size: 0.9rem;
        }
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        /* Responsive styling */
        @media screen and (max-width: 768px) {
            .orgchart .title {
                font-size: 1rem;
            }
            .orgchart .content {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>

    <!-- Chart Container -->
    <div id="chart-container"></div>

    <!-- jQuery -->
    <script src="{{ asset('orgchart/jquery.min.js') }}"></script>
    <!-- OrgChart JS -->
    <script src="{{ asset('orgchart/jquery.orgchart.js') }}"></script>
    <script>
        $(document).ready(function() {
            var datascource = {
                'name': 'Prof. Reini Wirahadikusumah Ph.D',
                'title': 'Rektor ITB',
                'avatar': '{{ asset("images/Rektor.jpg") }}', // Gambar Rektor
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
                                            {'name': 'Staff 1A', 'title': 'Staff', 'avatar': '{{ asset("images/1.jpg") }}'},
                                            {'name': 'Staff 1B', 'title': 'Staff', 'avatar': '{{ asset("images/2.jpg") }}'}
                                        ]
                                    },
                                    {
                                        'name': 'Verni Gunawan, A.Md',
                                        'title': 'Kasubdit 2',
                                        'avatar': '{{ asset("images/Kasubditormawa.jpg") }}',
                                        'children': [
                                            {'name': 'Staff 2A', 'title': 'Staff', 'avatar': '{{ asset("images/3.jpg") }}'},
                                            {'name': 'Staff 2B', 'title': 'Staff', 'avatar': '{{ asset("images/4.jpg") }}'}
                                        ]
                                    },
                                    {
                                        'name': 'syalalallal',
                                        'title': 'Kasubdit 3',
                                        'avatar': '{{ asset("images/Kasubditpp.jpg") }}',
                                        'children': [
                                            {'name': 'Staff 3A', 'title': 'Staff', 'avatar': '{{ asset("images/5.jpg") }}'},
                                            {'name': 'Staff 3B', 'title': 'Staff', 'avatar': '{{ asset("images/6.jpg") }}'}
                                        ]
                                    },
                                    {
                                        'name': 'alalalallalalal',
                                        'title': 'Kasubdit 4',
                                        'avatar': '{{ asset("images/Kasubditkm.jpg") }}',
                                        'children': [
                                            {'name': 'Staff 4A', 'title': 'Staff', 'avatar': '{{ asset("images/7.jpg") }}'},
                                            {'name': 'Staff 4B', 'title': 'Staff', 'avatar': '{{ asset("images/8.jpg") }}'}
                                        ]
                                    },
                                    {
                                        'name': 'parampambpam',
                                        'title': 'Kasubdit 5',
                                        'avatar': '{{ asset("images/Kasubdita.jpg") }}',
                                        'children': [
                                            {'name': 'Staff 5A', 'title': 'Staff', 'avatar': '{{ asset("images/9.jpg") }}'},
                                            {'name': 'Staff 5B', 'title': 'Staff', 'avatar': '{{ asset("images/10.jpg") }}'}
                                        ]
                                    },
                                    {
                                        'name': 'wiuwiuwiuwiwuwiu',
                                        'title': 'Kasubdit 6',
                                        'avatar': '{{ asset("images/Kepalasek.jpg") }}',
                                    }
                                ]
                            }
                        ]
                    }
                ]
            };
    
            // Initialize orgchart
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
    

</body>
</html>
