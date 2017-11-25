<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<li>
		<?php echo $user['fname']; ?>

		<?php echo $user['lname']; ?>

		from
		<?php echo $user['loc']; ?>

	</li>
		

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>