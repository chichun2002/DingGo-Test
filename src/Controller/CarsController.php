<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\View\ViewBuilder;

/**
 * Cars Controller
 *
 * @property \App\Model\Table\CarsTable $Cars
 */
class CarsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Requests');
    }
    public function index()
    {
    }

    public function cars()
    {
        $this->request->allowMethod(["get"]);
        $this->ViewBuilder()->disableAutoLayout();
        
        $this->Requests->update();
        
        $cars = $this->fetchTable("Cars")->find();
        $quotes = $this->fetchTable("Quotes")->find()->all();
        $isEmpty = $cars->count() === 0;

        $this->set(compact('cars', 'quotes', 'isEmpty'));
    }

    // /**
    //  * View method
    //  *
    //  * @param string|null $id Car id.
    //  * @return \Cake\Http\Response|null|void Renders view
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function view($id = null)
    // {
    //     $car = $this->Cars->get($id, contain: []);
    //     $this->set(compact('car'));
    // }

    // /**
    //  * Add method
    //  *
    //  * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
    //  */
    // public function add()
    // {
    //     $car = $this->Cars->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $car = $this->Cars->patchEntity($car, $this->request->getData());
    //         if ($this->Cars->save($car)) {
    //             $this->Flash->success(__('The car has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The car could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('car'));
    // }

    // /**
    //  * Edit method
    //  *
    //  * @param string|null $id Car id.
    //  * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function edit($id = null)
    // {
    //     $car = $this->Cars->get($id, contain: []);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $car = $this->Cars->patchEntity($car, $this->request->getData());
    //         if ($this->Cars->save($car)) {
    //             $this->Flash->success(__('The car has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The car could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('car'));
    // }

    // /**
    //  * Delete method
    //  *
    //  * @param string|null $id Car id.
    //  * @return \Cake\Http\Response|null Redirects to index.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $car = $this->Cars->get($id);
    //     if ($this->Cars->delete($car)) {
    //         $this->Flash->success(__('The car has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The car could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }
}
