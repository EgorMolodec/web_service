<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>


            <h4>Посмотреть отчёты по курсу</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <label for="studentName">Курс: </label>
                        <select name="studentName" id="studentName">
                            <?php 
                            echo '<option value="">Выберете студента</option>';

                            foreach ($studentsList as $student) {
                                unset($id, $name);
                                $id = $student['intUserID'];
                                $name = $student['email']; 
                                echo '<option value="'.$id.'">'.$name.'</option>';

                            } 
                            ?>
                        </select>
                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Показать">

                        <br/><br/>

                    </form>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Дата загрузки</th>
                                <th>Задание</th>
                                <th>Студент</th>
                                <th>Работа</th>
                                <th>Результат</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reportIDs as $report): ?>
                                <tr>
                                    <td><?php echo $report['intDate']; ?></td>
                                    <td>
                                        <a href="/report/task/<?php echo $report['intTaskID']; ?>">
                                            <?php echo $report['txtTaskName']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/report/student/<?php echo $report['intUserID']; ?>">
                                            <?php echo $report['intUserID']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $report['intWorkID']; ?></td>
                                    <td><?php echo $report['txtResult']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>