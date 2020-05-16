import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { RegFourPage } from './reg-four.page';

describe('RegFourPage', () => {
  let component: RegFourPage;
  let fixture: ComponentFixture<RegFourPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegFourPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(RegFourPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
