import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { RegFivePage } from './reg-five.page';

describe('RegFivePage', () => {
  let component: RegFivePage;
  let fixture: ComponentFixture<RegFivePage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegFivePage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(RegFivePage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
