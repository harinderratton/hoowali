import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { RegFourPageRoutingModule } from './reg-four-routing.module';

import { RegFourPage } from './reg-four.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RegFourPageRoutingModule
  ],
  declarations: [RegFourPage]
})
export class RegFourPageModule {}
