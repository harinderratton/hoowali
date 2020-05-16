import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { RegThreePage } from './reg-three.page';

describe('RegThreePage', () => {
  let component: RegThreePage;
  let fixture: ComponentFixture<RegThreePage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegThreePage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(RegThreePage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
