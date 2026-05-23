<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PSUController extends Controller
{
    
       public function welcome (){
            return "Welcome, Glend Allyzza R. Loresco";
        }
        public function mission (){
            return "MISSION <br> The Pangasinan State University, shall provide a human-centric, resielinet, and sustainable academic <br> 
            environment to produce dynamic, responsive, and future-ready individual capable of meeting the <br> requirements 
            of the local and global 
            communities and industries.";
        }
         public function vision (){
            return "VISION 
            <br>To be a leading industry-driven State University in the ASEAN region by 2030";
        }
       public  function EOMSPolicy (){
            return "EOMS POLICY <br>
            The Pangasinan State University, shall be recognized as an ASEAN premier <br>state university that provides quality education and 
            satisfactory service delivery through instruction, research, extension, and production
          <br> <br> We commit our expertise and resources to product professionals who meet the expectations of the industry and other interested 
          parties in the national and international community.
            <br><br>We shall continuosly improve our operations in responsw to the changing environment and in support of the instruction's 
            strategic direction. 
            ";
        }











        public function student ($name, $course){
            return "Student  : {$name} | Course:   {$course}";
        }

    
}