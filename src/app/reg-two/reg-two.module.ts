import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { RegTwoPageRoutingModule } from './reg-two-routing.module';

import { RegTwoPage } from './reg-two.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RegTwoPageRoutingModule
  ],
  declarations: [RegTwoPage]
})
export class RegTwoPageModule {}
