<?php

class Contact
{

    private $json ;

    public function __construct()
    {
        $this->json = new Json('database/contact.json');
    }

    public function create($name , $number , $description)
    {
        $id = $this->json->getLastId("contacts") + 1;
        $insert = $this->json->insert("contacts" , ["id" => $id , "name" => $name ,"number" => $number , "description" => $description ] );
        if($insert)
        {
            return true;
        }
        return false;
    }//create function end
	
	public function update($id , $name , $number , $description)
	{
		$data = ["name" => $name , "number" => $number , "description" => $description ];
		$update = $this->json->update($id , "contacts" , $data );
		if($update)
		{
			return true;
		}
		return false;
	}
	
	public function delete($id , $data)
	{
		$delete = $this->json->delete($id , "contacts" , $data );
		if($delete)
		{
			return true;
		}
		return false;
	}
	
    public function result()
    {
        return $this->json->resultByNode("contacts");
    }

    public static function ModalAddContact()
    {
        echo  <<<EOT
            <form action="index.php" method="post">
                <div class="modal fade" id="modalAddContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Contact</h4>
                      </div>
                      <div class="modal-body">
                           <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                          </div>
                          <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="number" class="form-control" id="number" name="number" placeholder="Enter Number">
                          </div>
                          <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="btnAddContact" >Save</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
EOT;

    }//end ModalAddContact


    public static function ModalUpdateContact($id)
    {
		$static = new static;
        $data = $static->json->resultById($id , "contacts");
        echo  <<<EOT
            <form action="index.php?id={$id}" method="post">
                <div class="modal fade" id="modalUpdateContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Add Contact</h4>
                      </div>
                      <div class="modal-body">
                           <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="uname" placeholder="Enter Name" value="{$data->name}">
                          </div>
                          <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="number" class="form-control" id="number" name="unumber" placeholder="Enter Number" value="{$data->number}">
                          </div>
                          <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="udescription" placeholder="Enter Description" value="{$data->description}">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <a href="index.php" class="btn btn-secondary">Close</a>
                        <button type="submit" class="btn btn-primary" name="btnUpdateContact" >Update</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
EOT;

    }//end ModalUpdateContact


}