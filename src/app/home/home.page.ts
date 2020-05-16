import { Component } from '@angular/core';
import { Platform } from '@ionic/angular';
@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  lat: number = 51.678418;
  lng: number = 7.809007;
  height = 0;

  constructor(public platform: Platform) {
    this.height = platform.height() - 56;
  }

}
