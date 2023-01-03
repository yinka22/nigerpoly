<?php
 $tablename = "adminlogin";
 $query = " SELECT * FROM $tablename".TABLEPREFIX;
 $res = $db->db_query("",$query);
 $datalist = $db->db_result_assoc_rows($res);
  $roleOptions = $db->SelectOptions("role","id","role_name"," ")
?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><i class="fa fa-building"></i> Users</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"><a href="" class="btn btn-success roleFormModal" data-toggle="modal" data-target="#roleFormModal"><i class="fa fa-plus"></i> New</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Users List</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
										     <th>ID</th>
                                            <th>Name</th>
											<th>Surname</th> 
											<th>Othername</th>                                              
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($datalist as $key => $value) {
                                            $dbid = $value["id"];
                                            $dbname = $value["username"]; 
											 $dbsname = $value["surname"];
											 $dboname = $value["othername"];                                    
                                            $dbstatus = $value["role_enabled"]==1 ? "Active" : "Not Active";
                                        ?>
                                        <tr>
										     <td><?php echo $dbid ?></td>
                                            <td><?php echo $dbname ?></td>  
											
											    <td><?php echo $dbsname ?></td>  
												  <td><?php echo $dboname ?></td>                                           
                                            <td><?php echo $dbstatus ?></td>
                                            <td>
                                                <a class="btn " 
                                                    data-id="<?php echo $dbid ?>" 
                                                    data-name="<?php echo $dbname ?>" 
													 data-sname="<?php echo $dbsname ?>" 
													  data-dboname="<?php echo $dboname ?>"                                                  
                                                    data-role="<?php echo $value["role_enabled"] ?>" 
                                                    onclick="roleEditModel(this)"
                                                ><i class="fa fa-pencil"></i> Edit </a>

                                                
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->



        <div class="modal fade" id="roleFormModal" tabindex="-1" role="dialog" aria-labelledby="rolesModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rolesModal">New User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" class="form-horizontal" >
                                                            
                                                            <input id="id" name="id" value="0" type="hidden" />
                                                            <input id="fdtable" name="fdtable" value="<?php echo $tablename ?>" type="hidden" />
                                                            
                                                            <div class="row form-group">
                                                                <div class="col col-sm-5"><label for="username" class=" form-control-label">Username</label></div>
                                                                <div class="col col-sm-6"><input type="text" id="role_name" name="username" placeholder="Username " class="input-lg form-control-lg form-control required-text" required></div>
                                                            </div>
															 <div class="row form-group">
                                                                <div class="col col-sm-5"><label for="password" class=" form-control-label">Password</label></div>
                                                                <div class="col col-sm-6"><input type="text" id="password" name="password" placeholder="password Name" class="input-lg form-control-lg form-control required-text" required></div>
                                                            </div>
															 <div class="row form-group">
                                                                <div class="col col-sm-5"><label for="surname" class=" form-control-label">Surname</label></div>
                                                                <div class="col col-sm-6"><input type="text" id="surname" name="surname" placeholder="Surname" class="input-lg form-control-lg form-control required-text" required></div>
                                                            </div>
															<div class="row form-group">
                                                                <div class="col col-sm-5"><label for="othername" class=" form-control-label">Othername</label></div>
                                                                <div class="col col-sm-6"><input type="text" id="othername" name="othername" placeholder="Othername" class="input-lg form-control-lg form-control required-text" required></div>
                                                            </div>
                                                              <div class="row form-group">
                                                                <div class="col col-sm-5"><label for="description" class=" form-control-label">Role</label></div>
                                                                <div class="col col-sm-6">
                                                                    <select id="role_id" name="role_id" class="form-control required-text">
                                                                        <?php echo $roleOptions ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col col-sm-5"><label for="role_enabled" class=" form-control-label">Active?</label></div>
                                                                <div class="col col-sm-6"><input type="checkbox" id="role_enabled" name="role_enabled"  class="input-lg " value=0 onclick="checkOption(this)"></div>
                                                            </div>
                                </form>
                            </div>
                            <div class="message_display text-center " id="message_display">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" data-url="actions.php" onclick="GeneralSaveControl(this)"  data-operation="save_fdform" data-redirect="" data-refresh="true"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
        </div>

        <script>
            function roleEditModel(e){
                var _this = $(e);
                var id = _this.data("id");
                var name = _this.data("name");
                var description = _this.data("description");
                var status = _this.data("status");
                // Set the values
                $("#id").val(id);
                $("#role_name").val(name);            
                $("#role_enabled").val(status);
                $(".roleFormModal").click(); // Show the Model
            }
        </script>
