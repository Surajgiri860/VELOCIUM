

<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>;
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout Closing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        h2 {
            color:rgb(235, 238, 242);
            font-weight: 600;
            margin-bottom: 30px;
        }
        .table {
            background-color: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .table thead th {
            background-color: #2c3e50;
            color: white;
            font-weight: 500;
            vertical-align: middle;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .table tfoot th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .btn-success, .btn-secondary {
            padding: 12px 40px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40,167,69,0.3);
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108,117,125,0.3);
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <?php $__env->startSection('content'); ?>
    <div class="container">
        <h2 class="mb-4 text-center">Payout Closing - User List</h2>
        <!-- <div class="text-center mt-4">
            <form action="<?php echo e(route('payout.closing')); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-lg btn-success">Process Payout</button>
            </form>
            
        </div> -->

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Total Balance ($)</th>
                        <th>Withdrawable Balance ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $grandTotalBalance = 0;
                        $grandWithdrawableBalance = 0;
                    ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $totalBalance = $user->staking_balance + $user->direct_balance + $user->level_balance + $user->royalty_balance;
                            $withdrawableBalance = $user->withdrawable + $totalBalance;

                            $grandTotalBalance += $totalBalance;
                            $grandWithdrawableBalance += $withdrawableBalance;
                        ?>
                        <tr>
                            <td><strong><?php echo e($user->referal_code); ?></strong></td>
                            <td><?php echo e($user->name); ?></td>
                            <td>$<?php echo e(number_format($totalBalance, 2)); ?></td>
                            <td>$<?php echo e(number_format($withdrawableBalance, 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="2" class="text-right">Total:</th>
                        <th>$<?php echo e(number_format($grandTotalBalance, 2)); ?></th>
                        <th>$<?php echo e(number_format($grandWithdrawableBalance, 2)); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-center mt-4">
         <form action="<?php echo e(route('payout.closing')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-lg btn-success">
                    Process Payout close
                </button>
            </form>
            <h2>
            <?php
                $lastPayout = $payoutClosings->first();
            ?>

            <?php if($lastPayout): ?>
            <div class="alert alert-info text-center">
                Last Payout Date: 
                <?php echo e($lastPayout->created_at
                    ->setTimezone('Asia/Kolkata')
                    ->format('d M Y h:i A')); ?> IST
            </div>
            <?php endif; ?>
             <?php if($payoutClosings->count()): ?>
                <div class="text-center mt-4">
                    <a href="<?php echo e(route('payout.download.latest')); ?>" 
                    class="btn btn-lg btn-success">
                        Download Last Payout Excel
                    </a>
                </div>
            <?php endif; ?>
            </h2>
            
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>

<?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>;<?php /**PATH C:\xampp\htdocs\VELOCIUM\resources\views/Admin/payout_list.blade.php ENDPATH**/ ?>