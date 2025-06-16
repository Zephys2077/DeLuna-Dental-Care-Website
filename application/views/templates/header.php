<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DeLuna | <?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            background: linear-gradient(135deg, #B8860B 0%, #DAA520 100%);
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            width: 16.666667%;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        /* Adjust main content margin */
        @media (min-width: 992px) {
            .col-lg-10 {
                margin-left: 16.666667%;
                width: 83.333333%;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .col-md-9 {
                margin-left: 25%;
                width: 75%;
            }
            .sidebar {
                width: 25%;
            }
        }
        /* Customize scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 5px;
        }

        .sidebar h4 {
            color: #fff;
            font-weight: 600;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .user-panel {
            padding: 15px 0;
            color: #fff;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            padding: 12px 15px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #fff !important;
            background: rgba(139, 69, 19, 0.2);
            transform: translateX(5px);
        }

        .nav-link.active {
            background: rgba(139, 69, 19, 0.3);
            color: #fff !important;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .nav-link:hover i {
            transform: scale(1.2);
        }
    </style>
    <style>
        .content-wrapper {
            min-height: calc(100vh - 120px);
            padding-bottom: 60px;
        }
        
        .main-footer {
            margin-left: 0;
            z-index: 1000;
        }
    </style>
    <style>
        .small-box {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .small-box .icon {
            position: absolute;
            right: 20px;
            top: 20px;
            opacity: 0.3;
            font-size: 60px;
        }

        .small-box:hover .icon {
            font-size: 65px;
        }

        .small-box .inner {
            padding: 20px;
        }

        .small-box h3 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            white-space: nowrap;
            padding: 0;
        }

        .table td, .table th {
            vertical-align: middle;
        }
    </style>
    <!-- Add jQuery before other scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">