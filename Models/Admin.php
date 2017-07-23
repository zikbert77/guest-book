<?php

namespace Models;

include ROOT.'/Core/Model.php';

use Core\Model;

class Admin extends Model
{

    public function getAllUsers ()
    {

        $users = array();

        $stmt = $this->db->query( 'SELECT user_id, email, username, join_date, stat_id FROM users ORDER BY join_date DESC' );

        $i = 0;
        while ( $row = $stmt->fetch( \PDO::FETCH_ASSOC ) ) {

            $users[$i]['user_id'] = $row['user_id'];
            $users[$i]['email'] = $row['email'];
            $users[$i]['username'] = $row['username'];
            $users[$i]['join_date'] = $row['join_date'];
            $users[$i]['stat_id'] = $row['stat_id'];

            $i++;
        }

        return $users;
    }

    public function getUser ( $id )
    {
        $user = array();

        $stmt = $this->db->prepare( 'SELECT user_id, email, username, join_date, stat_id FROM users WHERE user_id = :user_id ORDER BY join_date DESC' );
        $stmt->execute( array( 'user_id' => $id ) );

        $i = 0;
        $row = $stmt->fetch( \PDO::FETCH_ASSOC );

        $user['user_id'] = $row['user_id'];
        $user['email'] = $row['email'];
        $user['username'] = $row['username'];
        $user['join_date'] = $row['join_date'];
        $user['stat_id'] = $row['stat_id'];


        return $user;
    }

    public function manageUser ( $edit )
    {
        $stmt = $this->db->prepare( 'UPDATE users SET stat_id = :status WHERE user_id = :user_id' );
        $stmt->execute( array( 'status' => $edit['status'] ,'user_id' => $edit['id'] ) );

        if ( $stmt->rowCount() == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllStatuses ()
    {
        $statuses = array();

        $stmt = $this->db->query( 'SELECT stat_id, stat_title FROM statuses' );

        $i = 0;
        while ( $row = $stmt->fetch( \PDO::FETCH_ASSOC ) ) {

            $statuses[$i]['stat_id']    = $row['stat_id'];
            $statuses[$i]['stat_title'] = $row['stat_title'];

            $i++;
        }

        return $statuses;
    }

    public function getStatusName ( $id )
    {

        $stmt = $this->db->prepare( 'SELECT stat_title FROM statuses WHERE stat_id = ?' );
        $stmt->execute( array( $id ) );

        $stat = $stmt->fetch( \PDO::FETCH_ASSOC );

        return $stat['stat_title'];
    }

}