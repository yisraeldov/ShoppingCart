<?php
/**
 * The controller for the items
 *
 * @package default
 * @author ישראל דוב לבו
 */
class ItemsController extends AppController {

    var $helpers = array('Html','Ajax','Javascript','Form');    
    var $components = array( 'RequestHandler' );

    var $name = 'Items';

    function index() {

        //detect mobile platform
        $isMobile = $this->RequestHandler->isMobile();
        //if($isMobile) echo "MOBILE!!" ;
        $this->set('isMobile',$isMobile);
        $this->Item->recursive = 0;

        // load the items that are still to buy
        $this->paginate = array(
            //		 'conditions' => array('item.bought' => array(0,null,"")),
        'conditions' =>array('OR'=>array( array('item.bought is null ' ) , array('item.bought = 0'))) , 
            'limit' => 100
            );
        $this->set('items', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid item', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('item', $this->Item->read(null, $id));
    }

    /**
     * Calculate some stats
     *
     * @return void
     * @author ישראל דוב לבו
     */
    function stats(){
        if($this->RequestHandler->isMobile()) $this->layout = 'ajax';
        $stats = $this->Item->query("select sum(quantity*price) as total from items where(modified > date('now'))  ;");
        $this->set('stats',$stats);
    }

    /**
     * Loads a list of previously purchased items and their average price
     *
     * @return void
     * @author ישראל דוב לבו
     */
    function average(){
        $limit = 100;
        $fields = array(
            'lower(Item.name) as name',
            'avg(item.quantity) as quantity',
            'avg(item.price) as price',
            'max(item.modified) as last_modified',
            'bought'
            );
        $groupby ='name';
        $this->paginate= array(
            'limit'=>$limit,
            'fields'=>$fields,
            'group' => $groupby,
            'order' => 'name',
            );
        $this->set('items', $this->paginate());
    }


    /**
     * Add an item.
     *
     * @return void
     * @author ישראל דוב לבו
     */
    function add() {
        if (!empty($this->data)) {
            $this->Item->create();
            if ($this->Item->save($this->data)) {
                if(!$this->RequestHandler->getAjaxVersion()){
                    $this->Session->setFlash(__('The item has been saved', true));
                    $this->redirect(array('action' => 'index'));
                }
                else {
                    $this->redirect(array('action'=>'view',$this->Item->id));
                }
            } else {
                $this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
            }
        }
    }

    /**
     * Edit an item
     *
     * @param int $id the item id to edit 
     * @return void
     * @author ישראל דוב לבו
     */
    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid item', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Item->save($this->data)) {
                $this->Session->setFlash(__('The item has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Item->read(null, $id);
        }
    }


    /**
     * Marks and item as bought
     *
     * @param int $id the item id to mark as bought
     * @return void
     * @author ישראל דוב לבו
     */
    function bought($id = null){

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid item', true));
            $this->redirect(array('action' => 'index'));
        }

        if (empty($this->data)) {
            $this->Item->read(null, $id);
            $this->Item->set('bought',1);
            $this->Item->save();
            $this->redirect(array('action'=>'index'));

        }
    }

    /**
     * Delete an item
     *
     * @param int $id the item id to delete
     * @return void
     * @author ישראל דוב לבו
     */
    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for item', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Item->delete($id)) {
            $this->Session->setFlash(__('Item deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Item was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
}

