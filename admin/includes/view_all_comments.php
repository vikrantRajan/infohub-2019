<?php 
if($_SESSION['user_role'] == 'Admin') {
    ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php Comments::showComments(); ?>
    </tbody>
    <ul class="pagination">
        <?php Comments::pager(); ?>
    </ul>
</table>
<?php Comments::updateComments(); ?>

<?php
}
?>