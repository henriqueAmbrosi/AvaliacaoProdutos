import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-alert',
  templateUrl: './alert.component.html',
  styleUrls: ['./alert.component.css']
})
export class AlertComponent implements OnInit {


  messages: string[];
  type: string;
  message: string;

  constructor() {
    this.type= "success";
    this.message= ""
    this.messages= []
   }

  ngOnInit(): void {
  }

}
